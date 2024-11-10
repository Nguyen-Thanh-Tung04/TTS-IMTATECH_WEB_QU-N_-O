<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        $Category = Category::query()->get();
        return view('client.auth.login', compact('Category'));
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Get the user's credentials from the request
        $credentials = $request->only('email', 'password');
    
        // Find the user by email to check their status
        $user = User::where('email', $request->email)->first();
    
        // Check if the user exists and if their account is active
        if ($user && $user->status !== 'active') {
            return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ hỗ trợ.']);
        }
    
        // Attempt login if the account is active
        if (Auth::attempt($credentials)) {
            // Login successful, redirect to the desired page
            return redirect()->route('home'); // Replace 'home' with the desired route
        }
    
        // Login unsuccessful, display an error message
        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }
    

    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng
    
        return redirect()->route('login'); 
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