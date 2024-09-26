<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->with(['category'])->latest('id')->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('categories', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        dd($request->all());
        // $data = $request->except('img_thumb');
        // $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        // $data['is_best_sale'] = isset($data['is_best_sale']) ? 1 : 0;
        // $data['is_40_sale'] = isset($data['is_40_sale']) ? 1 : 0;
        // $data['is_hot_online'] = isset($data['is_40_saleis_hot_online']) ? 1 : 0;

        // if ($request->hasFile('cover')) {
        //     $data['img_thumb'] = Storage::put(self::PATH_UPLOAD, $request->file('img_thumb'));
        // } else {
        //     $data['img_thumb'] = '';
        // }
        // Product::query()->create($data);
        // return redirect()->route('admin.categories.index')->with('message', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}