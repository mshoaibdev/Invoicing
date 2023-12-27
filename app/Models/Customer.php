<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'lead_type',
        'status',
        'user_id',
        'date',
        'notes'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'in_progress' => 'boolean',
    ];


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


    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

   

    protected static function booted()
    {
        static::deleting(function ($customer) {

            $customer->invoices()->delete();
        });
    }
}
