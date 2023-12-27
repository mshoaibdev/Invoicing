<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'start_date',
        'end_date',
        'address',
        'services',
        'customer_id',
        'created_by',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // created_by

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'customer_id' => 'integer',
        'created_by' => 'integer',
    ];

}
