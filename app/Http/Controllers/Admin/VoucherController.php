<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\voucher;
use Illuminate\Support\Facades\Storage;

class VoucherController extends Controller
{
    const PATH_VIEW = 'admin.vouchers.';
    const PATH_UPLOAD = 'Vouchers';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = voucher::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'sku', 'quantity', 'end_at','discount']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        voucher::create($data);

        return redirect()->route('admin.vouchers.index')->with('message', 'Thêm mới thành công');
    }
    public function show(Voucher $Voucher)
    {
//        dd($category);
        return view(self::PATH_VIEW . __FUNCTION__, compact('Voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $Voucher)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('Voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $Voucher)
{
    $data = $request->only(['name', 'sku', 'quantity', 'end_at','discount']);
    $data['is_active'] = $request->has('is_active') ? 1 : 0;
    
    $Voucher->update($data);

    return redirect()->route('admin.vouchers.index')->with('message', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $Voucher)
    {
        //
        $Voucher->delete();
        return back()->with('message', 'Xóa thành công');
    }
}