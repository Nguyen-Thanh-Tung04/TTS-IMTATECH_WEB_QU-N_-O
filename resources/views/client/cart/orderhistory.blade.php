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

<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container ">
        <h3 class="cart-page-title">Tất cả đơn hàng</h3>
        <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>

                                <tr>
                                    <th>Mã Đơn Hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành động</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{$item->sku}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{ number_format($item->total_price, 0, ',', '.')}} đ</td> 
                                    @if($item->order_status === 'pending')
                                    <td class="text-danger fw-bold">{{ $ORDER_STATUS[$item->order_status] }}</td>  
                                    @else
                                    <td class="text-success fw-bold">{{ $ORDER_STATUS[$item->order_status] }}</td>  
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('clients.histryDetail', ['id' => $item->id]) }}" class="btn btn-dark btn-sm">Chi tiết</a>                                        </div> 
                                    </td>                                      
                                </tr>
                            @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </form>

            </div>
        </div>

        <div class="cart-shiping-update-wrapper d-flex justify-content-end">
            <div class="cart-clear mr-1 ml-auto bg-black">
              <a href="{{route('home')}}">Tiếp tục mua sắm</a>
            </div>
        </div>

    </div>

</div>

@endsection