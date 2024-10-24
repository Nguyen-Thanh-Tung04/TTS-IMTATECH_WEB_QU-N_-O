@extends('admin.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')

<div class="container pt-4">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-center text-dark">CHI TIẾT ĐƠN HÀNG</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="bg-light p-3 rounded">
                        <h3 class="text-center">Thông tin khách hàng</h3>
                        <ul>
                            <li>Họ tên: {{$order->receiver_name}}</li>
                            <li>Địa chỉ: {{$order->receiver_address}}</li>
                            <li>Số điện thoại: {{$order->receiver_phone}}</li>
                        </ul>
                    </div>
                    <div class="bg-light p-3 rounded mt-3">
                        <h3 class="text-center">Thông tin đơn hàng</h3>
                        <ul>
                            <li>Mã đơn hàng: {{$order->sku}}</li>
                            <li>Ngày đặt hàng: {{$order->created_at}}</li>
                            <li>Phương thức thanh toán: {{$order->payment_method}}</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="bg-light p-3 rounded">
                        <h3 class="text-center">ĐƠN HÀNG</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $sp)
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <img class="img-fluid" style="height: 50px" src="{{ Storage::url($sp->product_img_thumb) }}" alt="Product Image">
                                        </td>
                                        <td>{{ $sp->product_name }}</td>
                                        <td>{{ $sp->variant_color_name }}</td>
                                        <td>{{ $sp->variant_size_name }}</td>
                                        <td>{{ $sp->quantity }}</td>
                                        <td>{{ number_format($sp->product_price, 0, ',', '.') }} đ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div>
                                @if($order->order_status === 'pending')
                                <p class="bg-danger text-white rounded p-2">{{ $ORDER_STATUS[$order->order_status] }}</p>
                                @else
                                <p class="bg-success text-white rounded p-2">{{ $ORDER_STATUS[$order->order_status] }}</p>
                                @endif
                            </div>
                            <div>
                                <p class="fw-bold">Thành tiền: {{ number_format($order->total_price, 0, ',', '.') }} đ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-end">
    <button onclick="window.print()" class="btn btn-primary" style="width:200px; margin-right: 50px;">In Hóa Đơn</button>
</div>
   
@endsection
