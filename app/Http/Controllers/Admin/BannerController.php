<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Banner;

use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    const PATH_VIEW = 'admin.banners.';
    const PATH_UPLOAD = 'banners';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only(['name', 'stt', 'content', 'end_at']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('img')) {
            $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        } else {
            $data['img'] = '';
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('message', 'Thêm mới thành công');
    }
    public function show(Banner $banner)
    {
//        dd($category);
        return view(self::PATH_VIEW . __FUNCTION__, compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
{
    $data = $request->only(['name', 'stt', 'content', 'end_at']);
    $data['is_active'] = $request->has('is_active') ? 1 : 0;

    if ($request->hasFile('img')) {
        $data['img'] = Storage::put(self::PATH_UPLOAD, $request->file('img'));
        // Xóa file cũ trong storage
        if ($banner->img) {
            Storage::delete($banner->img);
        }
    }
    
    $banner->update($data);

    return redirect()->route('admin.banners.index')->with('message', 'Cập nhật thành công');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
        $banner->delete();
        return back()->with('message', 'Xóa thành công');
    }

    /**
     * Store a newly created resource in storage.
     */
}