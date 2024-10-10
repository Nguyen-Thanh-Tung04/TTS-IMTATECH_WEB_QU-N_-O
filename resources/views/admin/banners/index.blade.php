@extends('admin.layouts.master')

@section('title')
    Danh sách Banners
@endsection

@section('content')
    <a href="{{route('admin.banners.create')}}">
        <button class="btn btn-success">Tạo mới</button>
    </a>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
        @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách Banner</h1>

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
                            <th>Nội dung</th>
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
                                <th>Nội dung</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <div style="width: 100px; height: 100px;">
                                        <img src="{{Storage::url($item->img)}}" style="max-width: 100%; max-height: 100%;" alt="">
                                    </div>
                                </td>
                                <td>{{$item->content}}</td>
                                <td>{{$item->created_at}}</td>  
                                <td>{{$item->end_at}}</td>
                                <td>
                                    {!! $item->is_active ? '<span class="badge bg-success"> Hoạt động </span>' :
                                        ' <span class="badge bg-danger"> Không hoạt động </span>'!!}
                                </td>
                                <td class="d-flex ">
                                    <a href="{{route('admin.banners.show', $item)}}">
                                        <button class="btn btn-success ">Xem</button>
                                    </a>
                                    <a href="{{route('admin.banners.edit', $item)}}">
                                        <button class="btn btn-warning mx-2">Sửa</button>
                                    </a>
                                    <form action="{{route('admin.banners.destroy', $item)}}" method="POST">
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
