@extends('layouts.master')

@section('content')
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-4">Đặt hàng thành công!</h1>
            <p class="lead">Chúng tôi rất biết ơn sự quan tâm của bạn.</p>
            <hr class="my-4">
        </div>
    </div>
    {{-- <div class="container">
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
                                @foreach ($orderItems as $sp)
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
                                        {{ $sp->product_price }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 d-flex justify-content-between">
                            <div class="Place-order ">
                                <p class="btn-hover text-danger">Chờ xác nhận</p>
                            </div>
                            <div>
                                <p class="fw-bold">Thành tiền: {{$order->total_price}}đ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
            <div class="cart-shiping-update-wrapper d-flex justify-content-end">
                <div class="cart-clear mr-1 ml-auto bg-black">
                  <a href="{{route('home')}}">Tiếp tục mua sắm</a>
                </div>
            </div>
              
        </div>
            
        </div>
    </div> --}}
    
</div>

@endsection
