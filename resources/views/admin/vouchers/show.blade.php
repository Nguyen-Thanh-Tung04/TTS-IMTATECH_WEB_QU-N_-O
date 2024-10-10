@extends('admin.layouts.master')

@section('title')
    Chi tiết phiếu giảm giá
@endsection

@section('content')
    <ul>
        <li>Mã : {{$Voucher->sku}}</li>
        <li>Tên: {{$Voucher->name}}</li>
        <li>quantity: {{$Voucher->quantity}}</li>
        <li>quantity: {{$Voucher->discount}}</li>
        <li>Ngày tạo : {{$Voucher->created_at}}</li>
        <li>Ngày kết thúc : {{$Voucher->end_at}}</li>

        <li>Trạng thái: {{$Voucher->status}}</li>
    </ul>
@endsection
