<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $Category = Category::query()->get();
        return view('client.auth.login', compact('Category'));
    }

    public function login(Request $request) {
        
    }

    public function logout() {
        // Xử lý logic logout
    }
    public function vertify($token) {
        $user = User::query()
        ->where('email_verified',null)
        ->where('email',base64_decode($token))->firstOrFail();
        $user->update($token);
        if ($user){
            $user->update(['email_verified' =>Carbon::now()]);
            return redirect()->route('home')->with('success','Email đã được xác thực, bạn có thể đăng nhập');
        }
        
        // foreach ($users as $user) {
        //     if(base64_encode($token)) {
        //         $user->update(['email_verified' =>Carbon::now()]);
        //         return redirect()->route('client.login')->with('success','Email đã được xác thực, bạn có thể đăng nhập');
        //     }
        // }
    }

}