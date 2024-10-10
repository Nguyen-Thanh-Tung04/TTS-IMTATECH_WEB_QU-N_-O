@extends('admin.layouts.master')

@section('title')
    Danh sách mã giảm giá
@endsection

@section('content')
    <a href="{{route('admin.vouchers.create')}}">
        <button class="btn btn-success">Tạo mới</button>
    </a>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
        @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách mã giảm giá</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Mệnh giá</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Mệnh giá</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->sku}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->discount}}</td>
                                <td>{{$item->created_at}}</td>  
                                <td>{{$item->end_at}}</td>
                                <td>
                                    {!! $item->is_active ? '<span class="badge bg-success"> Hoạt động </span>' :
                                        ' <span class="badge bg-danger"> Không hoạt động </span>'!!}
                                </td>
                                <td class="d-flex ">
                                    <a href="{{route('admin.vouchers.show', $item)}}">
                                        <button class="btn btn-success ">Xem</button>
                                    </a>
                                    <a href="{{route('admin.vouchers.edit', $item)}}">
                                        <button class="btn btn-warning mx-2">Sửa</button>
                                    </a>
                                    <form action="{{route('admin.vouchers.destroy', $item)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')">Xóa</button>
                                    </form>
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
