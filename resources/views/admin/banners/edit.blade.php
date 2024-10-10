@extends('admin.layouts.master')

@section('title')
    Sửa danh mục sản phẩm
@endsection

@section('content')
   <div class="container">
    <form action="{{route('admin.banners.update', $banner)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tên:</label>
            <input type="text" name="name" value="{{$banner->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh:</label>
            <input type="file" name="img">
            <div style="width: 100px; height: 100px;">
                <img src="{{Storage::url($banner->img)}}" style="max-width: 100%; max-height: 100%;" alt="">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Số thứ tự:</label>
            <input type="number" class="form-control" name="stt" value="{{$banner->stt}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày kết thúc chiến dịch:</label>
            <input type="date" class="form-control" name="end_at" value="{{$banner->end_at}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <input class="form-check-input" type="checkbox" name="is_active" @checked($banner->is_active)>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
   </div>
@endsection
