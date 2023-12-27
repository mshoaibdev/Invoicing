<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'invoice_date',
        'due_date',
        'tax_amount',
        'tax_percentage',
        'items',
        'total',
        'subtotal',
        'uuid',
        'status',
        'payment_method',
        'currency',
        'customer_id',
        'note',
        'user_id',
        'payment_response',
        'invoice_link',
    ];

    protected $casts = [
        'total' => 'float',
        'subtotal' => 'float',
        'shipping' => 'float',
        'tax_amount' => 'float',
        'items' => 'array',
        'payment_response' => 'array',
        'user_id' => 'integer',
    ];

    protected $appends = ['invoice_id'];


    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function scopeSearch($query, $queryString)
    {
        // dd($queryString);
        if (Str::startsWith($queryString, 'INV')) {
            $id = Str::after($queryString, 'INV');
            $query->where('id', $id);
        }
        else{
            $query->where('id', $queryString);
        }

        return $query
            ->orWhere('total', 'like', '%'.$queryString.'%')
            ->orWhere('subtotal', 'like', '%' . $queryString . '%')
            ->orWhere('tax_amount', 'like', '%'.$queryString.'%')
            ->orWhere('payment_method', 'like', '%'.$queryString.'%')
            ->orWhere('status', 'like', '%'.$queryString.'%')
            ->whereHas('customer', function ($query) use ($queryString) {
                return $query->where('name', 'like', $queryString.'%');
            });
    }

    // created at
    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d-m-Y');
    // }

    protected function invoiceId(): Attribute
    {
        return Attribute::make(
            get: fn () => "INV{$this->id}",
        );
    }

    // protected function dueDate(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
    //         set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
    //     );
    // }

    // protected function invoiceDate(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
    //         set: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
    //     );
    // }

    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->customerId, function ($query, $customerId) {
                $query->where('customer_id', $customerId);
            })
            ->when($request->date_range, function ($query, $dateRange) {
                if (Str::contains($dateRange, 'to')) {
                    $dates = explode('to', $dateRange);
                    $date1 = Carbon::parse(trim($dates[0]))->format('Y-m-d');
                    $date2 = Carbon::parse(trim($dates[1]))->format('Y-m-d');
                    $query->whereBetween('invoice_date', [$date1, $date2]);
                }
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }
    /**
     * Get the quotes that owns the customer
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user that owns the invoice
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function ($item) {
        });
    }
}
