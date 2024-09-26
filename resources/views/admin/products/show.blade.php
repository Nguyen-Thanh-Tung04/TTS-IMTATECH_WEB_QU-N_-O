@extends('admin.layouts.master')

@section('title')
    Chi tiết danh mục sản phẩm
@endsection

@section('content')
    <ul>
        <li>ID: {{$product->id}}</li>
        <li>Tên: {{$product->name}}</li>
        <li>Ảnh:
            <div style="width: 100px; height: 100px;">
                <img src="{{Storage::url($product->image)}}" style="max-width: 100%; max-height: 100%;" alt="">
            </div>
        </li>
        <li>Danh mục :  {{$product->category->name}}</li>
        <li>
            Trạng thái:
            <span class="badge {{$product->is_active ? 'bg-success' : 'bg-danger'}}">
                {{$product->is_active ? 'Hoạt động' : 'Không hoạt động'}}
            </span>
        </li>        
       
    </ul>
@endsection
