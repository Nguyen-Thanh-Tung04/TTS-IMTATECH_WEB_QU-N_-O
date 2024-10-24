@extends('layouts.master')

@section('content')
<div class="breadcrumb-area" style="height: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box  align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                        <h2 class="breadcrumb-title">Đơn của tôi</h2>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list text-center text-md-end">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Đơn hàng</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area pt-100px pb-100px">

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="your-order-4">
                <div class="kh col-lg-4 mb-4">
                    <h3 class="text-center">Thông tin khách hàng</h3>
                    <ul>
                        <li>Họ tên : {{$order->receiver_name}}</li>
                        <li>Địa chỉ : {{$order->receiver_address}}</li>
                        <li>Số điện thoại : {{$order->receiver_phone}}</li>
                    </ul>
                </div>
                <div class="don col-lg-4">
                    <h3 class="text-center">Thông tin đơn hàng</h3>
                    <ul>
                        <li>Mã đơn hàng : {{$order->sku}}</li>
                        <li>Ngày đặt hàng : {{$order->created_at}}</li>
                        <li>Phương thức thanh toán : {{$order->payment_method}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="your-order-area">
                <h3 class="text-center">ĐƠN HÀNG</h3>
                <div class="table-content table-responsive cart-table-content">
                    <table>
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
                                <td class="product-thumbnail">
                                    <a href=""><img class="img-responsive ml-15px" src="{{ Storage::url($sp->product_img_thumb) }}" alt="" /></a>
                                </td>
                                <td class="product-name">
                                    <a href="">{{ $sp->product_name }}</a>
                                </td>
                                <td>{{ $sp->variant_color_name }}</td>
                                <td>{{ $sp->variant_size_name }}</td>
                                <td class="product-quantity">
                                    <span>{{ $sp->quantity }}</span>
                                </td>
                                <td class="product-subtotal">
                                    {{ number_format($sp->product_price, 0, ',', '.')}} đ
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="Place-order ">
                            @if($order->order_status === 'pending' || $order->order_status === 'cancel')
                            <p class=" bg-danger text-white rounded p-1">{{ $ORDER_STATUS[$order->order_status] }}</p>
                            @else
                            <p class=" bg-success text-white rounded p-1">{{ $ORDER_STATUS[$order->order_status] }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="fw-bold">Thành tiền: {{ number_format($order->total_price, 0, ',', '.')}} đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>                
        <div class="cart-shiping-update-wrapper ">
            <div class="cart-clear mr-1 ml-auto bg-black  d-flex justify-content-start">
                <a href="{{route('clients.orderhistry')}}">Quay lại</a>
              </div>
              <div class="d-flex justify-content-end">
                @if($order->order_status === 'pending')
<!-- Form để gửi yêu cầu cập nhật trạng thái đơn hàng -->
<form id="cancelOrderForm" action="{{ route('update.order') }}" method="POST">
    @csrf
    <input type="hidden" name="orderId" value="{{ $order->id }}">
    <input type="hidden" name="newStatus" value="cancel">
    <button type="submit" class="btn btn-dark btn-sm">Hủy đơn</button>
</form>                @else
                    <button class="btn btn-dark btn-sm" disabled>Không thể hủy đơn</button>
                @endif
            </div>
        </div>
       
          
    </div>
        
    </div>
</div>

</div>

@endsection