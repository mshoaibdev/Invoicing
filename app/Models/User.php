<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\UserPasswordReset;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
        'avatar',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $appends = ['name', 'avatar_url'];

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
            ->OrWhere('email', 'like', '%'.$queryString.'%')
            ->OrWhere('organization', 'like', '%'.$queryString.'%');
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

    /**
     * Get the user's full name.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->avatar ? asset('storage/avatars/'.$this->id.'/'.$this->avatar) : 'https://www.gravatar.com/avatar/'.md5($this->email).'?s=200&d=mm',
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordReset($token));
    }

    
}
