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

    protected $guarded = [
        'id'
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
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }

    public function billing()
    {
        return $this->hasOne(Address::class)->where('type', 'billing');
    }


    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
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

    

   

    protected static function booted()
    {
        static::deleting(function ($customer) {

            $customer->invoices()->delete();
        });
    }
}
