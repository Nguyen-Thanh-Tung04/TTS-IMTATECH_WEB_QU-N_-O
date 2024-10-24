@extends('admin.layouts.master')

@section('title')
    Danh sách Tài khoản
@endsection

@section('content')
    <a href="{{route('admin.banners.create')}}">
        <button class="btn btn-success">Tạo mới tài khoản</button>
    </a>
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
    </div>
        @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>email</th>
                            <th>Vai trò</th>
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>email</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->type}}</td>
                                <td class="d-flex ">
                                    <form action="{{route('admin.banners.destroy', $item)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?')">Khóa tài khoản</button>
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
