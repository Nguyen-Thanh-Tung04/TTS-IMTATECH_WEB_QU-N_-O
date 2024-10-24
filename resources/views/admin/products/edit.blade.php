@extends('admin.layouts.master')

@section('title')
    Sửa sản phẩm
@endsection
@section('script-libs')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor-classic'))
        .then(editor => {
            editor.setData(`{{$product->description}}`);
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tạo mơí sản phẩm</h1>
    <!--  Page main content   -->
    <!--   Main product information             -->
    <form action="{{route('admin.products.update',$product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')  
        <div class="row">
            <!--   left content-->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Main product information -->
                    <a href="#collapseProductInfo" class="d-block card-header py-3" data-toggle="collapse"
                       role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin chính của sản phẩm</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseProductInfo">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="product-title-input" class="form-label">Tên</label>
                                <input type="text" class="form-control" id="product-title-input" name="name"
                                       placeholder="Enter product title" value="{{$product->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="product-title-input" class="form-label">Giá</label>
                                <input type="text" class="form-control" id="product-title-input" name="price"
                                       placeholder="Enter product title" value="{{$product->price}}">
                            </div>
                            <div class="mb-3">
                                <label for="product-title-input" class="form-label">Giá sale</label>
                                <input type="text" class="form-control" id="product-title-input" name="price_sale"
                                       placeholder="Enter product title" value="{{$product->price_sale}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea id="ckeditor-classic" name="description" >
                                    {{ $product->description }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    gallery -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseProductGallery" class="d-block card-header py-3" data-toggle="collapse"
                       role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Hình ảnh sản phẩm</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseProductGallery">
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fs-14 mb-1">Hình ảnh sản phẩm</h5>
                                <p class="text-muted">Sửa ảnh sản phẩm.</p>
                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="d-flex">
                                            <div class="col-md-6">
                                                <input type="file" alt="" name="img_thumb" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{ Storage::url($product->img_thumb) }}" style="max-width: 80%; max-height: 80%;" alt="">
                                            </div>
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded">
                                                <img src="" id="product-img" class="avatar-md h-auto"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="fs-14 mb-1">Thư viện sản phẩm</h5>
                                <p class="text-muted">Sửa hình ảnh vào thư viện sản phẩm.</p>
                                <div class="d-flex">
                                    <div class="col-md-6">
                                        <input type="file" name="product_galleries[]" multiple class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        @if ($product->galleries->count())
                                        <img src="{{ Storage::url($product->galleries->first()->image) }}" style="max-width: 60%; max-height: 60%;" alt="">
                                         @endif
                                         {{-- With many image
                                         @foreach ($product->galleries as $gallery)
                                         <img src="{{ Storage::url($gallery->image) }}" style="max-width: 60%; max-height: 60%;" alt="">
                                        @endforeach --}}
                                     </div>
                                </div>

                                {{--                            <div class="dropzone">--}}
                                {{--                                <div class="fallback">--}}
                                {{--                                    <input name="file" type="file" multiple="multiple">--}}
                                {{--                                </div>--}}
                                {{--                                <div class="dz-message needsclick">--}}
                                {{--                                    <div class="mb-3">--}}
                                {{--                                        <i class="fa-solid fa-cloud-arrow-up fa-3x"></i>--}}
                                {{--                                    </div>--}}

                                {{--                                    <h5>Drop files here or click to upload.</h5>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}

                                {{--                            <ul class="list-unstyled mb-0" id="dropzone-preview">--}}
                                {{--                                <li class="mt-2" id="dropzone-preview-list">--}}
                                {{--                                    <!-- This is used as the file preview template -->--}}
                                {{--                                    <div class="border rounded">--}}
                                {{--                                        <div class="d-flex p-2">--}}
                                {{--                                            <div class="flex-shrink-0 me-3">--}}
                                {{--                                                <div class="avatar-sm bg-light rounded">--}}
                                {{--                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Product-Image" />--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex-grow-1">--}}
                                {{--                                                <div class="pt-1">--}}
                                {{--                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>--}}
                                {{--                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>--}}
                                {{--                                                    <strong class="error text-danger" data-dz-errormessage></strong>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex-shrink-0 ms-3">--}}
                                {{--                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
                                {{--                            </ul>--}}
                                <!-- end dropzon-preview -->
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Product variant --}}
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseProductGallery" class="d-block card-header py-3" data-toggle="collapse"
                       role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm biến thể</h6>
                    </a>
                    <div class="collapse show" id="collapseProductGallery">
                        <div class="card-body">
                            <div class="mb-4">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Màu</th>
                                        <th>Image</th>
                                        <th>Số lượng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productVariants as $variant)
                                            <tr>
                                                <td>
                                                    <select name="product_variants[{{$variant->id}}][size]" class="form-control">
                                                        @foreach($sizes as $size_id => $size_name)
                                                            <option value="{{$size_id}}" @if($size_id == $variant->size->id) selected @endif>{{$size_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="product_variants[{{$variant->id}}][color]" class="form-control">
                                                        @foreach($colors as $color_id => $color_name)
                                                            <option value="{{$color_id}}" @if($color_id == $variant->color->id) selected @endif>{{$color_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="file" alt="" name="product_variants[{{$variant->id}}][image]" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="product_variants[{{$variant->id}}][quantity]" value="{{$variant->quantity}}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-success">Thêm biến thể</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                        Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end left content    -->
            <!-- right content          -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseStatus" class="d-block card-header py-3" data-toggle="collapse"
                       role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Product status</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseStatus">
                        <!-- end card body -->
                        <div class="card-body">
                            <label for="choices-category-input" class="form-label">Danh mục sản phẩm</label>
                            <select class="form-control" aria-label="Default select example" id="choices-category-input" name="category_id">
                                @foreach($categories as $id => $name)
                                    <option value="{{$id}}" {{ $id == $product->category_id ? 'selected' : '' }}> {{$name}}</option>
                                @endforeach
                            </select>
                            <label for="choices-publish-status-input" class="form-label">Trạng thái</label>
                            {{-- <select class="form-control form-select-lg mb-3" id="choices-publish-status-input"
                                    aria-label="Default select example" name="is_active">
                                <option selected>-----------Trạng thái ----------</option>
                                @foreach($product as $id => $is_active)
                                <option value="{{$id}}" {{ $is_active ? 'selected' : '' }}>
                                    {{$id == 1 ? 'Hoạt động' : ($is_active ? 'Hoạt động' : 'Không hoạt động')}}
                                </option>
                            @endforeach
                            </select> --}}
                            <select class="form-control form-select-lg mb-3" id="choices-publish-status-input" aria-label="Default select example" name="is_active">
                                <option value="1" {{ $product->is_active ? 'selected' : '' }}>Hoạt động</option>
                                <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Không hoạt động</option>
                            </select>
                            {{--  Loại sản phẩm                      --}}
                            <label for="choices-publish-type-input" class="form-label">Loại sản phẩm</label>
                            @php
                                $types = [
                                        'is_best_sale' => 'Bán chạy',
                                        'is_40_sale' => 'Giảm 40%',
                                        'is_hot_online' => 'Hot online'
                                ];
                            @endphp
                            <div class="form-group custom-control custom-checkbox small d-flex align-items-center">
                                @foreach($types as $key => $value)
                                <div class="col-md-3">
                                    <input type="checkbox" class="custom-control-input" value="{{$key}}" name="{{$key}}" id="customCheck-{{$key}}"
                                           {{ $product->{$key} ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck-{{$key}}">{{$value}}</label>
                                </div>
                            @endforeach
                            </div>
                            {{--                        Mã sản phẩm --}}
                            <label for="choices-publish-type-input" class="form-label">Mã sản phẩm</label>
                            <input type="text" class="form-control" name="sku" value="{{$product->sku}}">                        </div>
                    </div>
                </div>
            </div>
            <!-- end right content       -->

        </div>
    </form>
</div>
@endsection
