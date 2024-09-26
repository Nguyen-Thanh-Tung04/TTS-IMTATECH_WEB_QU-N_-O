@extends('admin.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <a href="{{route('admin.products.create')}}">
        <button class="btn btn-success">Tạo mới</button>
    </a>
    @if (session('message'))
        <h3>{{session('message')}}</h3>
    @endif
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Tên</th>
            <th>Mã sẩn phẩm</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->sku}}</td>
                    <td>{{$item->price}}</td>

                    <td>
                        <div style="width: 100px; height: 100px;">
                            <img src="{{Storage::url($item->image)}}" style="max-width: 100%; max-height: 100%;" alt="">
                        </div>
                    <td class="d-flex ">
                        <a href="{{route('admin.products.show', $item)}}">
                            <button class="btn btn-success ">Xem</button>
                        </a>
                        <a href="{{route('admin.products.edit', $item)}}">
                            <button class="btn btn-warning mx-2">Sửa</button>
                        </a>
                        <form action="{{route('admin.products.destroy', $item)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody> 
    </table>
{{--  Phân trang  --}}
  {{-- {{$data ->links()}} --}}
@endsection
