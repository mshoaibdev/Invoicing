<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // fillable

    protected $fillable = [
        'name',
        'description',
    ];

    public function scopeSearch($query, $queryString)
    {
        return $query
            ->where('name', 'like', '%'.$queryString.'%')
            ->OrWhere('description', 'like', '%'.$queryString.'%');
    }
}
