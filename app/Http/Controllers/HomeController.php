<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Category = Category::query()->get();
        $Product = Product::query()->get();
        return view('welcome', compact('Category','Product'));
    }
    public function detail(string $id)
    {
        $Category = Product::query()->get();
        $Product = Product::query()->where('slug',$id)->first();
        return view('product_detail', compact('Category','Product'));
    }
    public function shop()
    {
        $Category = Category::query()->get();
        $Product = Product::query()->get();
        return view('shop', compact('Category','Product'));
    }
    // public function shopByCategory($iddm)
    // {
    //     $category = Category::all(); // Find category by slug
    
    //     $products = Product::where('category_id', $iddm)->get(); // Filter products
    
    //     // Pass the category as a separate variable
    //     return view('shop', compact('Category', 'products'));
    // }
    public function shopByCategory($iddm)
    {
        $Category = Category::query()->get();

        $selectedCategory = Category::findOrFail($iddm); // Tìm danh mục theo ID

        $Product = Product::where('category_id', $selectedCategory->id)->get();

        return view('shop', compact('Category', 'Product','selectedCategory'));
    }
    

}