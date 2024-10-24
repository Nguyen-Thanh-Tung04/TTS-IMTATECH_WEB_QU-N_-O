<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\orderItems;
use App\Models\voucher;
use Illuminate\Support\Facades\Auth;
use App\Events\OrderPlaced;
use App\Mail\OrderEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $Category = Category::query()->get();
        $totalAll = session('totalAll');

        return view('client.cart.cart', compact('Category', 'cart', 'totalAll'));
    }
    public function buyNow(Request $request)
    {
        $Category = Category::query()->get();
        $quantity = 1;
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $colors = $request->input('color_name');
        $size = $request->input('size_name');
        $img = $request->input('img');
        $sku = $request->input('sku');

        $total = $price * $quantity;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            $cart[$id]['img'] = $img;
            $cart[$id]['total'] += $total;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1,
                'img' => $img,
                'total' => $total,
                'colors' => $colors,
                'size' => $size,
                'sku' => $sku
            ];
        }

        $totalAll = 0;
        foreach ($cart as $item) {
            $totalAll += $item['total'];
        }

        session()->put('cart', $cart);
        session()->put('totalAll', $totalAll);

        $cartItemCount = count($cart);

        return view('client.cart.cart', compact('Category', 'cart', 'totalAll'));
    }

    public function addToCart(Request $request)
    {
        $quantity = 1;

        // Thực hiện logic thêm vào giỏ hàng

        $cart = session()->get('cart', []);

        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $colors = $request->input('color');
        $size = $request->input('size');
        $img = $request->input('img');
        $sku = $request->input('sku');

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
                'size' => $size,
                'sku' => $sku
            ];
        }

        // Tính lại tổng giá trị của tất cả sản phẩm trong giỏ hàng
        $totalAll = 0;
        foreach ($cart as $item) {
            $totalAll += $item['total'];
        }
        session()->put('cart', $cart);
        session()->put('totalAll', $totalAll);

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
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            // Cập nhật số lượng mới và giá mới
            $cart[$id]['quantity'] = $quantity;
            $cart[$id]['total'] = $price_total;

            // Tính lại totalAll
            $totalAll = 0;
            foreach ($cart as $item) {
                $totalAll += $item['total'];
            }

            session()->put('cart', $cart);
            session()->put('totalAll', $totalAll);

            return response()->json(['message' => 'Số lượng đã được cập nhật', 'cart' => $cart, 'totalAll' => $totalAll], 200);
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
            $removedItemTotal = $cart[$id]['total']; // Lưu giá trị của sản phẩm bị xóa
            unset($cart[$id]);

            // Tính lại tổng giá trị của tất cả sản phẩm trong giỏ hàng
            $totalAll = 0;
            foreach ($cart as $item) {
                $totalAll += $item['total'];
            }

            // Lưu giỏ hàng mới và tổng giá trị mới vào session
            session()->put('cart', $cart);
            session()->put('totalAll', $totalAll);

            // Chuyển hướng người dùng trở lại trang giỏ hàng
            return redirect()->route('client.cart')->with('message', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->route('client.cart')->with('error', 'Lỗi: Sản phẩm không tồn tại trong giỏ hàng.');
        }
    }
    public function removeCartOver()
    {
        session()->forget('cart');
        session()->forget('totalAll');

        $Category = Category::query()->get();
        return view('client.cart.cart', compact('Category'));
    }
    public function discount(Request $request)
    {
        $discountCode = $request->input('discount_code');
        $voucher = Voucher::where('sku', $discountCode)->first();

        if (!$voucher || $voucher->end_at < now()) {
            return response()->json(['error' => 'Mã giảm giá không hợp lệ mm']);
        }

        $discountAmount = $voucher->discount;
        session()->put('discount', $discountAmount);

        return response()->json(['success' => true, 'discountAmount' => $discountAmount, 'message' => 'Mã giảm giá đã được áp dụng']);
    }

    public function order()
    {
        $user = Auth::user();
        $cart = session('cart', []);
        $totalAll = session('totalAll');
        $discount = session('discount');


        // Lấy giá trị của discount từ session
        $discountAmount = session('discount', 0);

        $Category = Category::query()->get();

        return view('client.cart.order', compact('Category', 'cart', 'user', 'totalAll', 'discount'));
    }
    public function bill(Request $request)
    {
        // Lấy người dùng đã đăng nhập
        $user = Auth::user();
        // Lấy giá trị total_price từ trường input hidden
        $totalPrice = $request->input('total_price');


        // Tạo một đối tượng Order và lưu thông tin cơ bản
        $order = new Order();
        $order->sku          = $request->input('sku');
        $order->receiver_name = $request->input('name');
        $order->receiver_phone = $request->input('phone');
        $order->receiver_address = $request->input('address');
        $order->payment_method = $request->input('payment_method');
        $order->total_price = $totalPrice; // Gán giá trị total_price từ trường input hidden

        // Lưu thông tin người dùng đặt hàng
        $order->user_id = $user->id; // Lấy ID của người dùng đã đăng nhập
        // Lưu đơn hàng vào cơ sở dữ liệu
        $order->save();

        $cart = session('cart', []);

        foreach ($cart as $key => $item) {
            $orderItem = new orderItems(); // Chữ "orderItems" sửa thành "OrderItem" (chữ "I" in hoa)

            $orderItem->order_id = $order->id;
            $orderItem->product_name = $item['name'];
            $orderItem->product_price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->product_img_thumb = $item['img'];
            $orderItem->variant_color_name = $item['colors'];
            $orderItem->variant_size_name = $item['size'];
            $orderItem->product_sku = $item['sku'];
            $orderItem->product_variant_id = 1;
            $orderItem->save();
        }
        // Kích hoạt Event
        $token = Hash::make($user->email);
        Mail::to($user->email)->send(new OrderEmail($token, $user->name));

        session()->forget('cart');
        session()->forget('totalAll');
        return redirect()->route('clients.bill', ['order_id' => $order->id])->with('success', 'Đặt hàng thành công !');
    }
    public function bills(Request $request)
    {
        $user = Auth::user();

        $cart = session('cart', []);
        $order = session('order', []);
        // dd(count($order));

        $newOrder = new Order();
        $newOrder->sku = $order['sku'];
        $newOrder->user_id = $user->id;
        $newOrder->receiver_name = $order['name'];
        $newOrder->receiver_phone = $order['phone'];
        $newOrder->receiver_address = $order['address'];
        $newOrder->total_price = $order['total_price'];
        $newOrder->payment_method = $order['payment_method'];
        $newOrder->payment_status = 'unpaid';
        $newOrder->order_status = 'pending';
        $newOrder->save();

        // dd($newOrder);
        foreach ($cart as $key => $item) {
            $orderItem = new orderItems(); // Chữ "orderItems" sửa thành "OrderItem" (chữ "I" in hoa)
            $orderItem->order_id = $newOrder->id;
            $orderItem->product_name = $item['name'];
            $orderItem->product_price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->product_img_thumb = $item['img'];
            $orderItem->variant_color_name = $item['colors'];
            $orderItem->variant_size_name = $item['size'];
            $orderItem->product_sku = $item['sku'];
            $orderItem->product_variant_id = 1;
            $orderItem->save();
        }

        session()->forget('cart');
        session()->forget('totalAll');

        $Category = Category::all();

        // Lấy ID đơn hàng từ request
        $orderId = $request->input('order_id');

        // Lấy thông tin đơn hàng dựa trên ID
        $order = Order::find($orderId);
        $orderItems = orderItems::query()->where('order_id', $orderId)->get();

        return view('client.cart.bill', compact('Category', 'order', 'orderItems'));
    }
    public function orderhistry(Request $request)
    {
        $Category = Category::all();
        // Lấy ID của người dùng đang đăng nhập
        $user_id = Auth::id();

        // Truy vấn các đơn hàng của người dùng đó
        $data = Order::with('user')
            ->where('user_id', $user_id)
            ->latest('id')
            ->get();
        $ORDER_STATUS = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'preparing' => 'Đang chuẩn bị hàng',
            'shipping' => 'Đang giao',
            'delivered' => 'Đã giao',
            'cancel' => 'Hủy'
        ];

        return view('client.cart.orderhistory', compact('Category', 'data', 'ORDER_STATUS'));
    }
    public function histryDetail(Request $request, string $id)
    {
        $Category = Category::all();
        $data = orderItems::query()->where('order_id', $id)->get();
        // dd($data);
        $ORDER_STATUS = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'preparing' => 'Đang chuẩn bị hàng',
            'shipping' => 'Đang giao',
            'delivered' => 'Đã giao',
            'cancel' => 'Hủy'
        ];
        $order = Order::find($id);


        return view('client.cart.historyDetail', compact('order', 'Category', 'data', 'ORDER_STATUS'));
    }
    public function updateOrder(Request $request)
    {
        $orderId = $request->input('orderId');
        $newStatus = $request->input('newStatus');

        $order = Order::findOrFail($orderId); // Tìm đơn hàng

        if ($newStatus === 'cancel') {
            $order->order_status = 'cancel';
            $order->save(); // Lưu thay đổi
            return response()->json(['message' => 'Order status updated to Cancelled successfully']);
        } else {
            return response()->json(['message' => 'Invalid status update request']);
        }
    }
}