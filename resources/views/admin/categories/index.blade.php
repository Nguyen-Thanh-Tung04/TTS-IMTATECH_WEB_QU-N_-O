@extends('admin.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <a href="{{route('admin.categories.create')}}">
        <button class="btn btn-success">Tạo mới</button>
    </a>
    @if (session('message'))
        <h3>{{session('message')}}</h3>
    @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách sản phẩm</h1>

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
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
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
                                        <img src="{{Storage::url($item->cover)}}" style="max-width: 100%; max-height: 100%;" alt="">
                                    </div>
                                </td>
                                <td>
                                    {!! $item->is_active ? '<span class="badge bg-success"> Hoạt động </span>' :
                                        ' <span class="badge bg-danger"> Không hoạt động </span>'!!}
                                </td>
                                <td class="d-flex ">
                                    <a href="{{route('admin.categories.show', $item)}}">
                                        <button class="btn btn-success ">Xem</button>
                                    </a>
                                    <a href="{{route('admin.categories.edit', $item)}}">
                                        <button class="btn btn-warning mx-2">Sửa</button>
                                    </a>
                                    <form action="{{route('admin.categories.destroy', $item)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Xóa</button>
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
