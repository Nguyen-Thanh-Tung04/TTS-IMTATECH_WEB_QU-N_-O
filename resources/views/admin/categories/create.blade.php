@extends('admin.layouts.master')

@section('title')
    Tạo mới danh mục sản phẩm
@endsection

@section('content')
    <div class="container">
    <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh:</label>
            <input type="file" class="form-control" name="cover">
        </div>
        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
        <label class="form-check-label" for="is_active">Trạng thái</label>

        </div>
        <button type="submit" class="btn btn-success">Tạo mới</button>
    </form>
</div>
@endsection
