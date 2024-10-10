<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'quantity',
        'discount',
        'end_at',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}