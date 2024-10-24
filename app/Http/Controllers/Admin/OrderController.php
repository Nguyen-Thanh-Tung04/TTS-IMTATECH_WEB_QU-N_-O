<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\orderItems;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;


class OrderController extends Controller
{
    public function invoice($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
  
    const PATH_VIEW = 'admin.orders.';
    const PATH_UPLOAD = 'orders';
    public function index()
    {
        $data = Order::with('user')->latest('id')->get();

        $ORDER_STATUS = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'preparing' => 'Đang chuẩn bị hàng',
            'shipping' => 'Đang giao',
            'delivered' => 'Đã giao',
            'cancel' => 'Hủy'
        ];

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'ORDER_STATUS'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = OrderItems::query()->where('order_id', $id)->get();
        
        $ORDER_STATUS = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'preparing' => 'Đang chuẩn bị hàng',
            'shipping' => 'Đang giao',
            'delivered' => 'Đã giao',
            'cancel' => 'Hủy'
        ];
        
        $order = Order::find($id);
    
        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'data', 'ORDER_STATUS'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $orderId = $request->input('orderId');
        $newStatus = $request->input('newStatus');

        $order = Order::findOrFail($orderId); // Tìm đơn hàng
        $order->order_status = $newStatus;
        $order->save(); // Lưu thay đổi

        return response()->json(['message' => 'Order status updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
       
}