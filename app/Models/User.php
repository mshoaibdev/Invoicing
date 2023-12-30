<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\UserPasswordReset;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'organization',
        'phone',
        'address',
        'zip',
        'state',
        'country',
        'timezone',
        'currency',
        'email',
        'password',
        'status',
        'creator_id',
    ];

    protected $appends = [
        'name',
        'avatar_url',
        'is_super_admin',
    ];

    protected $guard_name = 'sanctum';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearch($query, $queryString)
    {
        return $query
            ->where('first_name', 'like', '%'.$queryString.'%')
            ->OrWhere('last_name', 'like', '%'.$queryString.'%')
            ->OrWhere('email', 'like', '%'.$queryString.'%');
    }

   // created at
   public function getCreatedAtAttribute($value)
   {
       return \Carbon\Carbon::parse($value)->format('d-m-Y');
   }

    /**
     * Get the user's full name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    public function getIsSuperAdminAttribute()
    {
        return ($this->role == 'super admin') || ($this->role == 'admin');
    }

    /**
     * Get the user's full name.
     */
    protected function avatarUrl(): Attribute
    {
        $avatar = $this->getMedia('avatar')->first();

        return Attribute::make(
            get: fn() => $avatar ? $avatar->getFullUrl() : 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=200&d=mm',
        );
    }

    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->role, function ($query, $role) {
                $query->role($role);
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function scopeInvoicesBetween($query, $start, $end)
    {
        $query->whereHas('invoices', function ($query) use ($start, $end) {
            $query->whereBetween(
                'invoice_date',
                [$start->format('Y-m-d'), $end->format('Y-m-d')]
            );
        });
    }

    public function hasCompany($company_id)
    {
        $companies = $this->companies()->pluck('company_id')->toArray();

        return in_array($company_id, $companies);
    }

    public function getAllSettings()
    {
        return $this->settings()->get()->mapWithKeys(function ($item) {
            return [$item['key'] => $item['value']];
        });
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordReset($token));
    }

    public function isOwner()
    {
        if (Schema::hasColumn('companies', 'owner_id')) {
            $company = Company::find(request()->header('company'));

            if ($company && $this->id == $company->owner_id) {
                return true;
            }
        } else {
            return $this->role == 'super admin' || $this->role == 'admin';
        }

        return false;
    }


    // currentCompany


    public function companies()
    {
        return $this->belongsToMany(Company::class, 'user_company', 'user_id', 'company_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'creator_id');
    }


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    
}
