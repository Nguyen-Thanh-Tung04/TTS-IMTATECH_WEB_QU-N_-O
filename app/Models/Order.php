<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'payment_method',
        'paid_amount',
        'payment_status',
        'shipping_status'
    ];
    const ORDER_STATUS = [
        'pending' => 'Chờ xác nhận',
        'confirmed' => 'Đã xác nhận',
        'preparing' => 'Đang chuẩn bị hàng',
        'shipping' => 'Đang giao',
        'delivered' => ' Đã giao',
        'cancel' => 'Hủy'
    ];
    const STATUS_PENDING = 'pending';

    // payment
    const PAYMENT_STATUS = [
        'paid' => 'Đã thanh toán',
        'unpaid' => 'Chưa thanh toán'
    ];
    const UNPAID = 'unpaid';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Đảm bảo rằng 'user_id' là tên cột khóa ngoại trong bảng 'orders'
    }
    public function orderItems()
    {
        return $this->hasMany(orderItems::class, 'order_id');
    }
}