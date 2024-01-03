<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable=[
        'user_id',
        'payment_method_id',
        'company_id',
        'amount',
        'transaction_id',
        'notes',
        'payment_date',
        'order_details',
        'payment_response',
    ];

    protected $appends = [
        'formattedCreatedAt',
        'formattedPaymentDate',
    ];

    protected $casts = [
        'amount' => 'integer',
        'payment_response' => 'array',
        'payment_date' => 'date',
        'company_id' => 'integer',
        'payment_method_id' => 'integer',
        'user_id' => 'integer',

    ];

    // protected static function booted()
    // {
    //     static::created(function ($payment) {
    //         GeneratePaymentPdfJob::dispatch($payment);
    //     });

    //     static::updated(function ($payment) {
    //         GeneratePaymentPdfJob::dispatch($payment, true);
    //     });
    // }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('F j, Y');
    }

    public function getFormattedPaymentDateAttribute()
    {
        return $this->payment_date->format('F j, Y');
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }


    public function paymentable()
    {
        return $this->morphTo();
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function scopeWhereCompany($query)
    {
        return $query->where('company_id', request()->header('company'));
    }

    public function scopeWherePaymentMethod($query, $payment_id)
    {
        return $query->orWhere('id', $payment_id);
    }

    public function scopeWhereSearch($query, $search)
    {
        return $query->where('transaction_id', 'like', '%'.$search.'%');
    }

    public function scopeWhereDate($query, $date)
    {
        return $query->whereDate('paid_on', $date);
    }

    public function scopeWhereDateRange($query, $from, $to)
    {
        return $query->whereBetween('paid_on', [$from, $to]);
    }

    public function scopeWherePaymentMethodId($query, $payment_method_id)
    {
        return $query->where('payment_method_id', $payment_method_id);
    }

    public function scopeWherePaymentable($query, $paymentable_id, $paymentable_type)
    {
        return $query->where('paymentable_id', $paymentable_id)->where('paymentable_type', $paymentable_type);
    }


}
