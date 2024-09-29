<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $Category = Category::query()->get();
        return view('client.cart.cart', compact('Category', 'cart'));
    }
    public function buyNow(Request $request)
    {
        $Category = Category::query()->get();

        $quantity = 1;
    
        // Example: Return the number of items in the cart
        $cartItemCount = 10;
    
        $cart = session()->get('cart', []);
    
        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $colors = $request->input('color_name');
        $size = $request->input('size_name');
    
        $img = $request->input('img');
        $total = $price * $quantity;
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            $cart[$id]['img'] = $img; // Add the 'img' field to the $cart[$id] array
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1,
                'img' => $img,
                'total' => $total,
                'colors' => $colors,
                'size' => $size
            ];
        }
    
        session()->put('cart', $cart);
        // Recalculate the number of items in the cart
        $cartItemCount = count($cart);
        // Return the result as JSON
        return view('client.cart.cart', compact('Category', 'cart'));


    }

    public function addToCart(Request $request)
{
    $quantity = 1;
    // Thực hiện logic thêm vào giỏ hàng

    // Ví dụ: Trả về số lượng sản phẩm trong giỏ hàng
    $cartItemCount = 10;

    $cart = session()->get('cart', []);

    $id = $request->input('id');
    $name = $request->input('name');
    $price = $request->input('price');
    $colors = $request->input('color');
    $size = $request->input('size');

    $img = $request->input('img');
    $total = $price * $quantity;

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
        $cart[$id]['img'] = $img; // Thêm trường 'img' vào mảng $cart[$id]
    } else {
        $cart[$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => 1,
            'img' => $img,
            'total' => $total,
            'colors' => $colors,
            'size' => $size
        ];
    }

    session()->put('cart', $cart);
    // Tính lại số lượng sản phẩm trong giỏ hàng
    $cartItemCount = count($cart);
    // Trả về kết quả dưới dạng JSON
    return response()->json([
        'cartItemCount' => $cartItemCount,
        'message' => 'Bạn đã thêm sản phẩm vào giỏ hàng thành công!'
    ]);
}
    public function updateQuantity(Request $request)
{
    $id = $request->input('id');
    $quantity = $request->input('quantity');
    $price_total = $request->input('total');
    // $cart[$id]['total']=0;
    $cart = session('cart', []);

    if (isset($cart[$id])) {
        // Cập nhật số lượng mới và giá mới
        $cart[$id]['quantity'] = $quantity;
        $cart[$id]['total'] = $price_total;

        session()->put('cart', $cart);

        return response()->json(['message' => 'Số lượng đã được cập nhật', 'cart' => $cart], 200);
    } else {
        return response()->json(['message' => 'Lỗi: Sản phẩm không tồn tại trong giỏ hàng'], 400);
    }
}
    public function removeCartItem(Request $request)
    {
        // Lấy thông tin sản phẩm cần xóa từ yêu cầu
        $id = $request->input('id');

        // Xử lý xóa sản phẩm khỏi giỏ hàng (session) của bạn ở đây
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            // Chuyển hướng người dùng trở lại trang giỏ hàng
            return redirect()->route('client.cart')->with('message', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->route('client.cart')->with('error', 'Lỗi: Sản phẩm không tồn tại trong giỏ hàng.');
        }
    }
    public function removeCartOver()
    {
        session()->forget('cart');
        $Category = Category::query()->get();
        return view('client.cart.cart', compact('Category'));
    }
    public function order()
    {
        $cart = session('cart', []);
        $Category = Category::query()->get();
        return view('client.cart.order', compact('Category', 'cart'));
    }
    public function bill()
    {
        $cart = session('cart', []);
        $Category = Category::query()->get();
        return view('client.cart.bill', compact('Category', 'cart'));
    }
}