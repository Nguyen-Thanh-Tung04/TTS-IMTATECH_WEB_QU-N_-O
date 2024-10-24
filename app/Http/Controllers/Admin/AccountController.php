<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    const PATH_VIEW = 'admin.accounts.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }
}