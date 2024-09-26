@extends('admin.layouts.master')

@section('title')
    Sửa sản phẩm
@endsection

@section('content')
    <form action="{{route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Mã sp*:</label>
            <input type="text" class="form-control" name="sku">
        </div>
        <div class="mb-3">
            <label class="form-label">Danh mục*:</label>
            <select class="form-select" name="category_id" id="">
                @foreach($categories as $id =>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Màu*:</label>
            <select class="form-select" name="color_id[]" id="">
                @foreach($colors as $id =>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>        
        </div>
        <div class="mb-3">
            <label class="form-label">Size*:</label>
            <select class="form-select" name="size_id[]" id="">
                @foreach($sizes as $id =>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>        
        </div>
        <div class="mb-3">
            <label class="form-label">Tên*:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">GIá*:</label>
            <input type="number" class="form-control" name="price">
        </div>
        <div class="mb-3">
            <label class="form-label">GIá Sale:</label>
            <input type="number" class="form-control" name="price_sale">
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh:</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả ngắn:</label>
            <input type="text" class="form-control" name="overview">
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết:</label>
            <input type="text" class="form-control" name="content">
        </div>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="is_featured" id="is_active" checked>
        <label class="form-check-label" for="is_featured">Trạng thái</label>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
@endsection
