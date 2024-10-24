@extends('admin.layouts.master')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')
    {{-- <a href="{{route('admin.orders.create')}}">
        <button class="btn btn-success">Tạo mới</button>
    </a> --}}
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
        @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách đơn hàng</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã</th>
                                <th>Tài khoản</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tiền</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Mã</th>
                                <th>Tài khoản</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tiền</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->sku}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->receiver_name}}</td>
                                    <td>{{$item->receiver_phone}}</td>
                                    <td>{{$item->receiver_address}}</td>

                                    <td>{{$item->total_price}}</td>
                                    <td class="btn bg-success text-white ml-4 mt-3" style="text-align: center">{{$item->payment_method}}</td>
                                    @if($item->order_status === 'cancel')
                                        <td class="text-danger fw-bold " style="text-align: center">{{ $ORDER_STATUS[$item->order_status] }}</td>  
                                    @else
                                    <td>
                                        <select class="form-select" onchange="updateOrderStatus(this, {{$item->id}})">
                                            @foreach($ORDER_STATUS as $key => $value)
                                            @if($key !== 'cancel')
                                                <option value="{{$key}}" {{$item->order_status == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endif
                                        @endforeach
                                        </select>                                        
                                    </td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.orders.show', $item) }}" class="btn btn-primary">Chi tiết</a>
                                            {{-- <form action="{{ route('admin.products.destroy', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')">Hủy đơn</button>
                                            </form> --}}
                                        </div>                                        
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    

{{--  Phân trang  --}}
{{--    {{$data ->links()}}--}}
@endsection
