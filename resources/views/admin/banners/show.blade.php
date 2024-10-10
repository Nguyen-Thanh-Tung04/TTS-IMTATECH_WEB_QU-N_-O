@extends('admin.layouts.master')

@section('title')
    Chi tiết danh mục sản phẩm
@endsection

@section('content')
    <ul>
        <li>ID: {{$banner->id}}</li>
        <li>Tên: {{$banner->name}}</li>
        <li>Ảnh:
            <div style="width: 100px; height: 100px;">
                <img src="{{Storage::url($banner->img)}}" style="max-width: 100%; max-height: 100%;" alt="">
            </div>
        </li>
        <li>STT : {{$banner->stt}}</li>
        <li>Ngày tạo : {{$banner->created_at}}</li>
        <li>Ngày kết thúc : {{$banner->end_at}}</li>

        <li>Trạng thái: {{$banner->status}}</li>
    </ul>
@endsection
