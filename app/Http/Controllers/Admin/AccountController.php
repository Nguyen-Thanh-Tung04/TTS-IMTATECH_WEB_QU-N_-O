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
    // app/Http/Controllers/admin/AccountController.php

    public function toggleStatus(User $user)
    {
        $user->status = $user->status === User::STATUS_ACTIVE ? User::STATUS_INACTIVE : User::STATUS_ACTIVE;
        $user->save();

        return redirect()->route('admin.accounts.index')->with('message', 'Trạng thái tài khoản đã được thay đổi!');
    }
    public function toggleType(User $user)
    {
        // Toggle the type between 'admin' and 'member'
        $user->type = $user->type === 'admin' ? 'member' : 'admin';
        $user->save();

        return redirect()->route('admin.accounts.index')->with('message', 'User type updated successfully!');
    }
}
