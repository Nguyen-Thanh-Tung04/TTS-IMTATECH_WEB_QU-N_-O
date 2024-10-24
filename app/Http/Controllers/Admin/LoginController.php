<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;



use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{

    public function index()
    {
        $Category = Category::query()->get();
        return view('admin.auth.login', compact('Category'));
    }

    public function login(Request $request)
    {
        // Validate dữ liệu từ request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Thử đăng nhập người dùng
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Đăng nhập thành công, chuyển hướng đến trang mong muốn
        return redirect()->route('admin.'); // Thay 'dashboard' bằng tên route mong muốn
    }

    // Đăng nhập không thành công, hiển thị thông báo lỗi
    return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
    }

    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng
    
        return redirect()->route('admin.auth.login'); 
    }
    public function vertify($token)
    {
        $user = User::query()
            ->where('email_verified', null)
            ->where('email', base64_decode($token))->firstOrFail();
        $user->update($token);
        if ($user) {
            $user->update(['email_verified' => Carbon::now()]);
            return redirect()->route('home')->with('success', 'Email đã được xác thực, bạn có thể đăng nhập');
        }

        foreach ($user as $user) {
            if (base64_encode($token)) {
                $user->update(['email_verified' => Carbon::now()]);
                return redirect()->route('client.login')->with('success', 'Email đã được xác thực, bạn có thể đăng nhập');
            }
        }
    }
}