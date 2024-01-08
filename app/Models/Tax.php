<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_type_id',
        'tax_amount',
        'tax_percentage',
    ];

    public function taxType()
    {
        return $this->belongsTo(TaxType::class);
    }

    public function taxable()
    {
        return $this->morphTo();
    }


}
