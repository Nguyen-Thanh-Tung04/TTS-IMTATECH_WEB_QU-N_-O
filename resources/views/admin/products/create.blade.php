
@extends('admin.layouts.master')
@section('title')
    Thêm mới sản phẩm
@endsection
@section('style-libs')
    <!-- Plugins css -->
    <link href="{{asset('theme/admin/libs/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('theme/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('script-libs')
    <!-- ckeditor -->
    <script src="{{asset('theme/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <!-- dropzone js -->
    <script src="{{asset('theme/admin/libs/dropzone/dropzone-min.js')}}"></script>

    <script src="{{asset('theme/admin/js/create-product.init.js')}}"></script>
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Tạo mới sản phẩm</h1>
        <!--  Page main content   -->
        <!--   Main product information             -->
        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                           placeholder="Enter product title">
                                           @if ($errors->has('name'))
                                           <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                       @endif
                                       @if ($errors->has('product_variants'))
                                       <div class="alert alert-danger">{{ $errors->first('product_variants') }}</div>
                                       @endif
                                </div>
                                <div class="mb-3">
                                    <label for="product-title-input" class="form-label">Giá</label>
                                    <input type="text" class="form-control" id="product-title-input" name="price"
                                           placeholder="Enter product title">
                                           @if ($errors->has('price'))
                                           <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                                       @endif
                                       
                                </div>
                                <div class="mb-3">
                                    <label for="product-title-input" class="form-label">Giá sale</label>
                                    <input type="text" class="form-control" id="product-title-input" name="price_sale"
                                           placeholder="Enter product title">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mô tả sản phẩm</label>
                                    <textarea name="description" id="ckeditor-classic" rows="4" cols="50">
                                        
                                    </textarea>
                                    @if ($errors->has('description'))
    <div class="alert alert-danger">{{ $errors->first('description') }}</div>
@endif
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
                                    <p class="text-muted">Thêm ảnh sản phẩm.</p>
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <input type="file" alt="" name="img_thumb" class="form-control">

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
                                    <p class="text-muted">Thêm hình ảnh vào thư viện sản phẩm.</p>
                                    <input type="file" name="product_galleries[]" multiple class="form-control">
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
                                    <table class="table" id="product-variants-table">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Màu</th>
                                                <th>Image</th>
                                                <th>Số lượng</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $amount = 5; @endphp
                                            @for($index = 1; $index <= $amount; $index++)
                                                <tr>
                                                    <td>
                                                        <select name="product_variants[{{$index}}][size]" class="form-control">
                                                            @foreach($sizes as $size_id => $size_name)
                                                                <option value="{{$size_id}}">{{$size_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="product_variants[{{$index}}][color]" class="form-control">
                                                            @foreach($colors as $color_id => $color_name)
                                                                <option value="{{$color_id}}">{{$color_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="product_variants[{{$index}}][image]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="product_variants[{{$index}}][quantity]">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger delete-variant">Xóa</button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                   
                                    <a class="btn btn-success" id="add-variant">Thêm biến thể</a>
                                </div>
                                @if ($errors->has('product_variants'))
                                <div class="alert alert-danger">{{ $errors->first('product_variants') }}</div>
                                @endif
                                
                                <script>
                                    document.getElementById('add-variant').addEventListener('click', function() {
                                        var table = document.getElementById('product-variants-table').getElementsByTagName('tbody')[0];
                                        var row = table.insertRow(-1);
                                        var index = table.rows.length - 1;
                                
                                        var sizeSelect = document.createElement('select');
                                        sizeSelect.name = 'product_variants[' + index + '][size]';
                                        sizeSelect.className = 'form-control';
                                        @foreach($sizes as $size_id => $size_name)
                                            var sizeOption = document.createElement('option');
                                            sizeOption.value = '{{$size_id}}';
                                            sizeOption.textContent = '{{$size_name}}';
                                            sizeSelect.appendChild(sizeOption);
                                        @endforeach
                                
                                        var colorSelect = document.createElement('select');
                                        colorSelect.name = 'product_variants[' + index + '][color]';
                                        colorSelect.className = 'form-control';
                                        @foreach($colors as $color_id => $color_name)
                                            var colorOption = document.createElement('option');
                                            colorOption.value = '{{$color_id}}';
                                            colorOption.textContent = '{{$color_name}}';
                                            colorSelect.appendChild(colorOption);
                                        @endforeach
                                
                                        var imageInput = document.createElement('input');
                                        imageInput.type = 'file';
                                        imageInput.name = 'product_variants[' + index + '][image]';
                                        imageInput.className = 'form-control';
                                
                                        var quantityInput = document.createElement('input');
                                        quantityInput.type = 'text';
                                        quantityInput.name = 'product_variants[' + index + '][quantity]';
                                
                                        var deleteButton = document.createElement('button');
                                        deleteButton.className = 'btn btn-danger delete-variant';
                                        deleteButton.textContent = 'Xóa';
                                
                                        var cell1 = row.insertCell(0);
                                        var cell2 = row.insertCell(1);
                                        var cell3 = row.insertCell(2);
                                        var cell4 = row.insertCell(3);
                                        var cell5 = row.insertCell(4);
                                
                                        cell1.appendChild(sizeSelect);
                                        cell2.appendChild(colorSelect);
                                        cell3.appendChild(imageInput);
                                        cell4.appendChild(quantityInput);
                                        cell5.appendChild(deleteButton);
                                    });
                                
                                    document.addEventListener('click', function(e) {
                                        if (e.target && e.target.classList.contains('delete-variant')) {
                                            e.target.closest('tr').remove();
                                        }
                                    });
                                </script>
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
                                <select class="form-control" aria-label="Default select example"
                                        id="choices-category-input" name="category_id">
                                    @foreach($categories as $id => $name)
                                        <option value="{{$id}}"> {{$name}}</option>
                                    @endforeach
                                </select>
                                <label for="choices-publish-status-input" class="form-label">Trạng thái</label>
                                <select class="form-control form-select-lg mb-3" id="choices-publish-status-input"
                                        aria-label="Default select example" name="is_active">
                                    <option selected>-----------Trạng thái ----------</option>
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
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
                                            <input type="checkbox" class="custom-control-input" value="{{$key}}" name="{{$key}}" id="customCheck-{{$key}}">
                                            <label class="custom-control-label" for="customCheck-{{$key}}">{{$value}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                {{--                        Mã sản phẩm --}}
                                <label for="choices-publish-type-input" class="form-label">Mã sản phẩm</label>
                                <input type="text" class="form-control" name="sku" value="{{strtoupper(\Str::random(8))}}">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end right content       -->

            </div>
        </form>
</div>
<!-- /.container-fluid -->
@endsection