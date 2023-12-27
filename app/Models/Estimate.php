<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estimate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'estimate_date',
        'expiry_date',
        'customer_id',
        'salesman_id',
        'notes',
        'payment_status',
        'sub_total',
        'total',
        'tax',
        'created_by',
        'updated_by',
        'items'
    ];

    protected $casts = [
        // 'estimate_date' => 'date',
        'expiry_date' => 'date',
        'customer_id' => 'integer',
        'salesman_id' => 'integer',
        'payment_status' => 'integer',
        'sub_total' => 'float',
        'total' => 'float',
        'tax' => 'float',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'items' => 'array'
    ];

    protected $appends = [
        'label',
    ];

    public function getLabelAttribute()
    {
        $formatter = new NumberFormatter('USD', NumberFormatter::CURRENCY);

        return $this->title . ' - ' . optional($this->customer)->name . ' - ' . $formatter->formatCurrency($this->total, 'USD');
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeSearch($query, $queryString)
    {
        // search customer name 

        $query->when($queryString, function ($query, $queryString) {
            $query->whereHas('customer', function ($query) use ($queryString) {
                $query->where('name', 'like', '%' . $queryString . '%')
                    ->orWhere('email', 'like', '%' . $queryString . '%')
                    ->orWhere('phone', 'like', '%' . $queryString . '%');
            });
        });
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    // estimate date

    // public function getEstimateDateAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('d-m-Y');
    // }

    // expiry date

    // public function getExpiryDateAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('d-m-Y');
    // }




    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->customerId, function ($query, $customerId) {
                $query->where('customer_id', $customerId);
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
            $query->latest();
        });
    }



    protected static function booted()
    {
        static::deleting(function ($item) {
            // $item->notes()->detach();
            // $item->invoices()->detach();
            // $item->quotes()->detach();
        });
    }

}