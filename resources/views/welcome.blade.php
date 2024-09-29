@extends('layouts.master')

@section('content')
<div class="section ">
    <div class="hero-slider h-75 swiper-container slider-nav-style-1 slider-dot-style-1 dot-color-white">
        <!-- Hero slider Active -->
        <div class="swiper-wrapper">
            <!-- Single slider item -->
            <div class="hero-slide-item slider-height-2 swiper-slide d-flex">
                <div class="hero-bg-image">
                    <img src="{{asset('theme/client/assets/images/slider-image/slider-2-2.webp')}}" style="width: 100%;
        height: auto;" alt="">
                </div>
                
            </div>  
            <!-- Single slider item -->
            <div class="hero-slide-item slider-height-2 swiper-slide d-flex text-center">
                <div class="hero-bg-image">
                    <img src="{{asset('theme/client/assets/images/slider-image/slider-2-1.jpg')}}" style="width: 100%;
        height: auto;"  alt="">
                </div>
                
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-white"></div>
        <!-- Add Arrows -->
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

<!-- Shop Category pages -->

<div class="section pt-4" style="height:300px">
    <div class="col-md-12 text-center" data-aos="fade-up">
        <div class="section-title mb-0">
            <h2 class="title">Danh mục</h2>
        </div>
    </div>
    <div class="container">
        <div class="category-slider swiper-container" data-aos="fade-up">
            <div class="category-wrapper swiper-wrapper">
                <!-- Single Category -->
                @foreach ($Category as $dm)
                <div class=" swiper-slide">
                    <a href="{{ route('shop.category', $dm->id) }}" class="category-inner ">
                        <div class="category-single-item">
                            <img class="rounded-circle w-50" src="{{Storage::url($dm->cover)}}" alt="">
                            <span class="title">{{$dm->name}}</span>
                        </div>
                    </a>
                </div>    
                @endforeach
            </div>
        </div>
    </div>
</div>


<!-- Product tab Area Start -->
<div class="section product-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" data-aos="fade-up">
                <div class="section-title mb-0">
                    <h2 class="title">Sản phẩm của chúng tôi</h2>
                </div>
            </div>

            <!-- Tab Start -->
            <div class="col-md-12 text-center mb-40px" data-aos="fade-up" data-aos-delay="200">
                <ul class="product-tab-nav nav justify-content-center">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                            href="#tab-product-new-arrivals">Sản phẩm nổi bật</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-best-sellers">Sản
                            phẩm mới </a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-product-sale-item">Mặt hàng
                            giảm giá</a>
                    </li>
                </ul>
            </div>
            <!-- Tab End -->
        </div>

<!-- Shop Category pages -->
<div class="shop-category-area pb-100px pt-70px">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tab-content">
                    <!-- 1st tab start -->
                    <div class="tab-pane fade show active" id="tab-product-new-arrivals">
                        <div class="row">
                            @foreach ($Product as $sp)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                                <!-- Single Prodect -->
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                            <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                            <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                        </a>
                                        <span class="badges">
                                            <span class="new">New</span>
                                        </span>
                                        <div class="actions">
                                            <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                    class="icon-heart"></i></a>
                                            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="icon-size-fullscreen"></i></a>
                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                    class="icon-refresh"></i></a>
                                        </div>
                                        {{-- <form class="AddToCartFormItem" method="post">
                                            <input type="hidden" name="id" value="{{$sp->id}}">
                                            <input type="hidden" name="name" value="{{$sp->name}}">
                                            <input type="hidden" name="img" value="{{$sp->img_thumb}}">
                                            <input type="hidden" name="price" value="{{$sp->price}}">
                                            <button title="Add To Cart" type="submit" name="themcart"
                                                class="addToCartButtonItem add-to-cart">Thêm vào giỏ hàng</button>
                                        </form> --}}
<button class="addToCartButtonItem add-to-cart btnCart" data-id="{{$sp->id}}"  onclick="addToCart(event, {{$sp->id}}, '{{$sp->name}}', {{$sp->price}}, '{{ $sp->img_thumb }}','Đen','M')">Thêm vào giỏ hàng</button>                                        {{-- <button title="Add To Cart" type="submit" name="themcart"
                                                class="addToCartButtonItem add-to-cart">Thêm vào giỏ hàng</button> --}}
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="shop-left-sidebar.html">{{$sp->name}}</a></h5>
                                        <span class="price">
                                            <span class="new">{{$sp->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
    
                        </div>
                    </div>
                    <!-- 1st tab end -->
                    <!-- 2nd tab start -->
                    <div class="tab-pane fade" id="tab-product-best-sellers">
                        <div class="row">
                            @foreach ($Product as $sp)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                                <!-- Single Prodect -->
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                            <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                            <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                        </a>
                                        <span class="badges">
                                            <span class="new">New</span>
                                        </span>
                                        <div class="actions">
                                            <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                    class="icon-heart"></i></a>
                                            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="icon-size-fullscreen"></i></a>
                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                    class="icon-refresh"></i></a>
                                        </div>
                                        <button title="Add To Cart" class=" add-to-cart">Thêm vào giỏ hàng</button>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="shop-left-sidebar.html">{{$sp->name}}</a></h5>
                                        <span class="price">
                                            <span class="new">{{$sp->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
    
                        </div>
                    </div>
                    <!-- 2nd tab end -->
                    <!-- 3rd tab start -->
                    <div class="tab-pane fade" id="tab-product-sale-item">
                        <div class="row">
                            @foreach ($Product as $sp)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                                <!-- Single Prodect -->
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                            <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                            <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                        </a>
                                        <span class="badges">
                                            <span class="new">New</span>
                                        </span>
                                        <div class="actions">
                                            <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                    class="icon-heart"></i></a>
                                            <a href="#" class="action quickview" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="icon-size-fullscreen"></i></a>
                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                    class="icon-refresh"></i></a>
                                        </div>
                                        <button title="Add To Cart" class=" add-to-cart">Thêm vào giỏ hàng</button>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="shop-left-sidebar.html">{{$sp->name}}</a></h5>
                                        <span class="price">
                                            <span class="new">{{$sp->price}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
    
                        </div>
                    </div>
                    <!-- 3rd tab end -->
                </div>
            </div>
        </div>
       
    </div>
</div>
</div>
@endsection