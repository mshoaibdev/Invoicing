<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'website',
        'company_name',
        'notes',
        'currency_id',
        'company_id',
        'creator_id',
    ];



    public function uniqueIds(): array
    {
        return ['uuid'];
    }


    public function scopeSearch($query, $queryString)
    {
        return $query
            ->where('name', 'like', '%'.$queryString.'%')
            ->OrWhere('email', 'like', '%'.$queryString.'%');
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function scopeWhereCompany($query)
    {
        return $query->where('company_id', request()->header('company'));
    }

    public function scopeWhereCreator($query)
    {
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return $query->where('creator_id', auth()->id());
        }
    }

    public function scopeWhereSearch($query, $request)
    {
        $query->when($request->q, function ($query, $search) {
            $query->search($search);
        });
    }


    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($request->companyId, function ($query, $companyId) {
                $query->where('user_id', $companyId);
            })
            // customerId
            ->when($request->customerId, function ($query, $customerId) {
                $query->where('customer_id', $customerId);
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }

   

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


    // addressable
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    // billing address
    public function billing()
    {
        return $this->morphOne(Address::class, 'addressable')->where('type', 'billing');
    }


    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }




    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    

   

    // protected static function booted()
    // {
    //     static::deleting(function ($customer) {

    //         $customer->invoices()->delete();
    //     });
    // }
}
