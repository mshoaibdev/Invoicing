<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'landline',
        'address',
        'currency',
        'vat_reg_number',
        'company_registration',
        'website_url',
        'payment_terms',
        'bank_account_number',
        'iban',
        'notes',
        'logo',
        'sort_code',
        'user_id',
    ];

    protected $appends = ['logo_url'];

    public function scopeSearch($query, $queryString)
    {
        return $query
            ->where('name', 'like', '%'.$queryString.'%')
            ->OrWhere('email', 'like', '%'.$queryString.'%');
    }

    // created at
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

     protected function logoUrl(): Attribute
     {
         return Attribute::make(
             get: fn () => $this->avatar ? asset('storage/company/'.$this->logo) : 'https://www.gravatar.com/avatar/'.md5($this->email).'?s=200&d=mm',
         );
     }

    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function ($item) {
            // $item->students()->delete();
            // $item->applications()->delete();
        });
    }
}
