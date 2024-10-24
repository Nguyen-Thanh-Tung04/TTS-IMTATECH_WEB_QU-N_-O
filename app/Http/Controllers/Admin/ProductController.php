<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->with(['category'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $data = $request->except(['product_variants', 'img_thumb', 'product_galleries']);
        $data['is_best_sale'] = isset($data['is_best_sale']) ? 1 : 0;
        $data['is_40_sale'] = isset($data['is_40_sale']) ? 1 : 0;
        $data['is_hot_online'] = isset($data['is_hot_online']) ? 1 : 0;
        $data['slug'] = Str::slug($data['name'] . '-' . $data['sku']);
        if (!empty($request->hasFile('img_thumb'))) {
            $data['img_thumb'] = Storage::put('products', $request->file('img_thumb'));
        }


        //dd($data);

        try {
            DB::beginTransaction();
            // tạo dữ liệu bảng product
            $product = Product::query()->create($data);
            // tạo dữ liệu cho bảng product variants
            // tạo dữ liệu cho bảng product variants
            foreach ($request->product_variants as $item) {
                if ($item['quantity'] > 0) {
                    $variant = ProductVariant::query()->firstOrNew([
                        'product_size_id' => $item['size'],
                        'product_color_id' => $item['color'],
                        'product_id' => $product->id
                    ]);
            
                    $variant->image = !empty($item['image']) ? Storage::put('product_variants', $item['image']) : '';
                    $variant->quantity = $item['quantity'];
            
                    $variant->save();
                }
            }
            foreach ($request->product_variants as $item) {
    if ($item['quantity'] > 0) {
        $variant = ProductVariant::query()->firstOrNew([
            'product_size_id' => $item['size'],
            'product_color_id' => $item['color'],
            'product_id' => $product->id
        ]);

        $variant->image = !empty($item['image']) ? Storage::put('product_variants', $item['image']) : '';
        $variant->quantity = $item['quantity'];

        $variant->save();
    }
}
            // tạo dữ liệu cho bảng product gallery
            foreach ($request->product_galleries as $item) {
                ProductGallery::query()->create([
                    'image' => Storage::put('product_galleries', $item),
                    'product_id' => $product->id
                ]);
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('message', 'Thêm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            // thực hiện xóa ảnh trong storage
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $products = Product::with('galleries')->get();
        $categories = Category::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $productVariants = $product->variants()->with('size', 'color')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('product', 'categories', 'sizes', 'colors', 'productVariants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->except(['product_variants', 'img_thumb', 'product_galleries']);
        $data['is_best_sale'] = $request->has('is_best_sale') ? 1 : 0;
        $data['is_40_sale'] = $request->has('is_40_sale') ? 1 : 0;
        $data['is_hot_online'] = $request->has('is_hot_online') ? 1 : 0;
        $data['slug'] = Str::slug($data['name'] . '-' . $data['sku']);

        // Check if a new image is uploaded
        if ($request->hasFile('img_thumb')) {
            // Delete old image before saving the new image
            if ($product->img_thumb) {
                Storage::delete($product->img_thumb);
            }
            $data['img_thumb'] = Storage::put('products', $request->file('img_thumb'));
        }

        try {
            DB::beginTransaction();

            // Update data in the product table
            $product->update($data);

            // Cập nhật dữ liệu trong bảng product variants
            if ($request->product_variants) {
                foreach ($request->product_variants as $item) {
                    $variant = ProductVariant::updateOrCreate(
                        [
                            'product_size_id' => $item['size'],
                            'product_color_id' => $item['color'],
                            'product_id' => $product->id
                        ],
                        [
                            'image' => !empty($item['image']) ? Storage::put('product_variants', $item['image']) : '',
                            'quantity' => !empty($item['quantity']) ? $item['quantity'] : 0
                        ]
                    );
                }
            }

            // Cập nhật dữ liệu trong bảng product gallery
            if ($request->product_galleries) {
                foreach ($request->product_galleries as $item) {
                    ProductGallery::updateOrCreate(
                        [
                            'product_id' => $product->id
                        ],
                        [
                            'image' => Storage::put('product_galleries', $item)
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('message', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            // Handle the error and delete images in storage if necessary
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            DB::beginTransaction();
            // Delete image from storage
            if ($product->img_thumb) {
                Storage::delete($product->img_thumb);
            }

            // Delete product variants
            ProductVariant::where('product_id', $product->id)->delete();

            // Delete product galleries
            ProductGallery::where('product_id', $product->id)->delete();

            // Delete product
            $product->delete();
            DB::commit();
            return redirect()->route('admin.products.index')->with('message', 'Xóa thành công !');
        }catch(\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
            return back(); 
        }
    }
}