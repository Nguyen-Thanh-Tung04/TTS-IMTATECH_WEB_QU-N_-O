@extends('layouts.master')

@section('content')
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-4">Đặt hàng thành công!</h1>
            <p class="lead">Chúng tôi rất biết ơn sự quan tâm của bạn.</p>
            <hr class="my-4">
        </div>

        <div class="col-lg-12">
            <div class="cart-shiping-update-wrapper">
                <div class="cart-clear m-auto">
                    <a href="{{route('home')}}">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
