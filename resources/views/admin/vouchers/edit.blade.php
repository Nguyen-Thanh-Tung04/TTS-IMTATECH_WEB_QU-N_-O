@extends('admin.layouts.master')

@section('title')
    Sửa danh mục mã giảm giá
@endsection

@section('content')
   <div class="container">
    <form action="{{route('admin.vouchers.update', $Voucher)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       
        <div class="mb-3">
            <label class="form-label">Mã giảm giá:</label>
            <input type="text" class="form-control" name="sku" value="{{strtoupper(\Str::random(8))}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Tên:</label>
            <input type="text" class="form-control" name="name" value="{{$Voucher->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng:</label>
            <input type="number" class="form-control" name="quantity" min="1" value="{{$Voucher->quantity}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Mệnh giá :</label>
            <input type="number" class="form-control" name="discount" min="0" value="{{$Voucher->discount}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày kết thúc chiến dịch:</label>
            <input type="date" class="form-control" name="end_at" value="{{$Voucher->end_at}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <input class="form-check-input" type="checkbox" name="is_active" @checked($Voucher->is_active)>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
   </div>
@endsection
