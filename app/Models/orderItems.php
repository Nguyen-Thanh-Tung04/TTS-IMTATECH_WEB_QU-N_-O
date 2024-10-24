<?php

namespace App\Models;

use App\Mail\OrderEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'product_name',
        'product_sku',
        'product_img_thumb',
        'product_price',
        'variant_size_name',
        'variant_color_name',
        'quantity'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}