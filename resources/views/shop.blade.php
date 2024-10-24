@extends('layouts.master')

@section('content')
<!-- breadcrumb-area start -->
<div id="loader">
    <div class="circle">
        <div class="circle1"></div>
        <div class="circle2"></div>
    </div>
</div>
<div class="breadcrumb-area" style="height: 50px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row breadcrumb_box  align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                        <h2 class="breadcrumb-title">Cửa hàng</h2>
                    </div>
                    <div class="col-lg-6  col-md-6 col-sm-12">
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list text-center text-md-end">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item active">sản phẩm</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->

<!-- Shop Category pages -->
<div class="shop-category-area pb-100px pt-70px">
    <div class="container">
        <h1 class="timk text-center"></h1>

        <div class="row">
            <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                <!-- Shop Top Area Start -->
                <div class="shop-top-bar d-flex p-2">
                    <!-- Left Side start -->
                    <p>Sản phẩm của cửa hàng</p>
                    <!-- Left Side End -->
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap d-flex align-items-center">
                      
                    </div>
                    <!-- Right Side End -->
                </div>
                <!-- Shop Top Area End -->

                <!-- Shop Bottom Area Start -->
                <div class="shop-bottom-area">
                    <div class="row">
                        @if (isset($selectedCategory))
                            @foreach ($Product as $sp)
                            <div class="col-lg-4  col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="200">
                                <!-- Single Prodect -->
                                <div class="product mb-25px">
                                    <div class="thumb">
                                        <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                            <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                            <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                        </a>
                                        <form class="AddToCartFormItem" method=" post">
                                            <input type="hidden" name="id" value="">
                                            <input type="hidden" name="name" value="">
                                            <input type="hidden" name="img" value="">
                                            <input type="hidden" name="price" value="">
                                            <button title="Add To Cart" type="submit" name="themcart"
                                                class="addToCartButtonItem add-to-cart">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="">{{$sp->name}}</a>
                                        </h5>
                                        <span class="price">
                                            <span
                                                class="new">{{$sp->price_sale}}</span>
                                            <span class="old">{{$sp->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>  
                            @endforeach
                        @elseif (isset($SpSearch))
                            <h1 class="pb-3">Kết quả tìm kiếm : {{request('search')}}</h1>
                            @foreach ($SpSearch as $sp)
                            <div class="col-lg-4  col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="200">
                                <!-- Single Prodect -->
                                <div class="product mb-25px">
                                    <div class="thumb">
                                        <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                            <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                            <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                        </a>
                                        <form class="AddToCartFormItem" method=" post">
                                            <input type="hidden" name="id" value="">
                                            <input type="hidden" name="name" value="">
                                            <input type="hidden" name="img" value="">
                                            <input type="hidden" name="price" value="">
                                            <button title="Add To Cart" type="submit" name="themcart"
                                                class="addToCartButtonItem add-to-cart">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="">{{$sp->name}}</a>
                                        </h5>
                                        <span class="price">
                                            <span
                                                class="new">{{$sp->price_sale}}</span>
                                            <span class="old">{{$sp->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>  
                            @endforeach
                        @else
                            @foreach ($Product as $sp)
                            <div class="col-lg-4  col-md-6 col-sm-6 col-xs-6" data-aos="fade-up" data-aos-delay="200">
                                <!-- Single Prodect -->
                                <div class="product mb-25px">
                                    <div class="thumb">
                                        <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                            <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                            <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                        </a>
                                        <form class="AddToCartFormItem" method=" post">
                                            <input type="hidden" name="id" value="">
                                            <input type="hidden" name="name" value="">
                                            <input type="hidden" name="img" value="">
                                            <input type="hidden" name="price" value="">
                                            <button title="Add To Cart" type="submit" name="themcart"
                                                class="addToCartButtonItem add-to-cart">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="">{{$sp->name}}</a>
                                        </h5>
                                        <span class="price">
                                            <span
                                                class="new">{{$sp->price_sale}}</span>
                                            <span class="old">{{$sp->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>  
                            @endforeach
                        @endif
                    </div>
                   
                    
                    <!--  Pagination Area Start -->
                    <div class="pro-pagination-style text-center mb-md-30px mb-lm-30px mt-30px" data-aos="fade-up">
                        <ul>
                            <li>
                                <a class="prev" href="#"><i class="ion-ios-arrow-left"></i></a>
                            </li>
                            <li><a class="active" href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li>
                                <a class="next" href="#"><i class="ion-ios-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!--  Pagination Area End -->
                </div>
                <!-- Shop Bottom Area End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-md-60px mb-lm-60px">
                <div class="shop-sidebar-wrap">
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget">
                        <div class="main-heading">
                            <h3 class="sidebar-title">Danh mục</h3>
                        </div>
                        <div class="sidebar-widget-category">
                            <ul>
                                @foreach ($Category as $dm)
                                <li><a href="{{ route('shop.category', $dm->id) }}">{{$dm->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Sidebar single item -->
                    <div class="sidebar-widget-group">

                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Size</h3>
                            <div class="sidebar-widget-category">
                                <ul>
                                  

                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->

                        <!-- Sidebar single item -->

                    </div>
                    <!-- Sidebar single item -->

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection