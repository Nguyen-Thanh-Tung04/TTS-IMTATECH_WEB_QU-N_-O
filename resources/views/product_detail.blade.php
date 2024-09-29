@extends('layouts.master')

@section('content')
<div class="offcanvas-overlay"></div>
<!-- breadcrumb-area start -->
<div class="breadcrumb-area" style="height: 50px">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
          <h2 class="breadcrumb-title">Sản phẩm</h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <ul class="breadcrumb-list text-center text-md-end">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="index.php?act=store">Sản phẩm</a></li>
            <li class="breadcrumb-item active">Sản phẩm chi tiết</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<!-- breadcrumb-area end -->

<!-- Product Details Area Start -->
<div class="product-details-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">


                        <div class="swiper-slide zoom-image-hover">
                            <img class="img-responsive m-auto" src="{{Storage::url($Product->img_thumb)}}" alt="">
                        </div>



                    </div>
                </div>

                <div class="swiper-container zoom-thumbs slider-nav-style-1 small-nav mt-15px mb-15px">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <img class="img-responsive m-auto" src="" alt="">
                        </div>


                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    <h2>{{$Product->name}}</h2>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                    </div>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut">
                                {{$Product->price}}
                                <del class="px-3 text-secondary

"><small></small></del>
                            </li>
                        </ul>
                    </div>
                    <p class="quickview-para"></p>
                    <form id="AddToCartForm" action="{{ route('buyNow')}}" method="post">
                        @csrf
                        <div class="pro-details-size-color d-flex">
                            <div class="pro-details-color-wrap mx-3">
                                <span>Màu</span>
                                <select class="form-control" id="selectedColor" name="color_name" onchange="setSelectedColor(this)" required>
                                    @foreach ($variants as $c)
                                    <option value="{{ $c->color }}">{{ $c->color }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pro-details-color-wrap">
                                <span>Kích cỡ</span>
                                <select class="form-control" id="selectedSize" name="size_name" onchange="setSelectedSize(this)" required>
                                    @foreach ($variants as $s)
                                    <option value="{{ $s->size }}">{{ $s->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class=" pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" required type="text" maxlength="1"
                                    onblur="validateInput(this);" name="p_quantity" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                <input type="hidden" name="id" value="{{$Product->id}}">
                                <input type="hidden" name="name" value="{{$Product->name}}">
                                <input type="hidden" name="img" value="{{$Product->img_thumb}}">
                                <input type="hidden" name="price" value="{{$Product->price}}">

                                <div class="addtocart-wrapper">
                                    <button class="btn btn-primary btn-hover-primary ml-4 mx-3" name="addtocart"
                                        type="submit">Mua ngay</button>
                                    <button id="addToCartButton" name="themcart" data-id="{{$Product->id}}"  onclick="addToCart(event, {{$Product->id}}, '{{$Product->name}}', {{$Product->price}}, '{{ $Product->img_thumb }}')"><i class="icon-handbag"></i>Thêm
                                        vào
                                        giỏ
                                        hàng</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>

            <div class="pro-details-policy">
                <ul>
                    <li><img src="assets/images/icons/policy.png" alt="" /><span>Chính sách bảo mật</span></li>
                    <li><img src="assets/images/icons/policy-2.png" alt="" /><span>Chính sách giao hàng</span></li>
                    <li><img src="assets/images/icons/policy-3.png" alt="" /><span>Chính sách hoàn trả</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a class="active" data-bs-toggle="tab" style="text-decoration: none;" href="#des-details2">Chi tiết
                    sản
                    phẩm</a>
                <a data-bs-toggle="tab" style="text-decoration: none;" href="#des-details3">Bình luận</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details2" class="tab-pane active">
                    <div class="product-anotherinfo-wrapper">
                        <p>{{$Product->description}}</p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">


                </div>
            </div>
        </div>

    </div>
</div>
<div class="section pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <!-- section title start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-start mb-11">
                    <h2 class="title">Sản Phẩm Khác Cùng Loại :</h2>
                </div>
            </div>
        </div>
        <!-- section title start -->
        <div class="new-product-slider swiper-container slider-nav-style-1" data-aos="fade-up" data-aos-delay="200">
            <div class="new-product-wrapper swiper-wrapper">
                @foreach ($Category as $sp)
                <div class="new-product-item swiper-slide">
                    <div class="product">
                        <div class="thumb">
                            <a href="{{route('product_detail',$sp->slug)}}" class="image">
                                <img src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                                <img class="hover-image" src="{{Storage::url($sp->img_thumb)}}" alt="Product" />
                            </a>
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="">{{$sp->name}}
                                </a></h5>
                            <span class="price">
                                <span class="new">{{$sp->price}}</span>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>

@endsection