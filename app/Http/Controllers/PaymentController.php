<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\client\CartController;
use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\orderItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function place(Request $request)
    {
        $pay_method = $request->payment_method;
        // dd($pay_method, $request);
        if ($pay_method == 'cash') {
            return $this->cash($pay_method, $request);
        } else if ($pay_method == 'vnpay') {
            return $this->vnpay_payment($pay_method, $request);
        }
    }
    public function cash($pay_method, $request)
    {
        // dd($pay_method, $request);
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

    public function vnpay_payment($pay_method, $request)
    {
        // dd($pay_method, $request);
        session()->put('order',$request->all());
        session()->save();
        
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('clients.bill'); // Đổi liên kết nà
        $vnp_TmnCode = "CGXZLS0Z"; //Mã website tại VNPAY
        $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; //Chuỗi bí mật
        
        $vnp_TxnRef = $request->sku ; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi
        $vnp_OrderInfo = 'Noi dung thanh toan';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis', strtotime('+100 days')),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
        if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
        'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
        } else {
            header('Location: ' . $vnp_Url);
            die();
        };
        // vui lòng tham khảo thêm tại code demo

        
    }
}