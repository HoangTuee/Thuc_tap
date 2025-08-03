<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banner;
use App\Models\sanpham;

class BannerController extends Controller
{
    //ql banner
    public function view_add_banner()
    {
        $allProducts = sanpham::select('tensanpham')->distinct()->get();
        return view('admin.form.Add_banner', compact('allProducts'));
    }
    public function add_banner(Request $request)
    {
        $request->validate([
            'tensanpham' =>'required|exists:sanpham,tensanpham',
            'anh_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lưu ảnh vào thư mục public/storage/banners
        $imageName = $request->file("anh_banner")->getClientOriginalName();
        $request->anh_banner->move(public_path('storage/banners'), $imageName);

        // Lưu đường dẫn vào database
        $banner = new Banner();
        $banner->anh_banner = 'storage/banners/' . $imageName;
        $banner->tensanpham = $request->tensanpham;
        $banner->save();

        return redirect()->route('qlbanner')->with('success', 'Ảnh đã được thêm thành công!');
    }

    public function view_edit_banner($id){
        $banner = Banner::findOrFail($id);
        return view('admin.form.Edit_banner', compact('banner'));
    }

    public function edit_banner(Request $request, banner $banner){
        $request->validate([
            'anh_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tensanpham' =>'required|exists:sanpham,tensanpham',
        ]);
        $imageName = $request->file('anh_banner')->getClientOriginalName();
        $request->anh_banner->move(public_path('storage/banners'), $imageName);
        // Lưu đường dẫn vào database
        $banner->anh_banner = 'storage/banners/' . $imageName;
        $banner->tensanpham = $request->tensanpham;
        $banner->save();

        return redirect()->route('qlbanner')->with('success', 'Ảnh đã được thay đổi thành công!');
    }


    public function delete_banner($id){
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return redirect()->route('qlbanner')->with('success', 'Xoa banner thanh cong');
    }

    public function qlbanner()
    {
        $banners = Banner::all();
        return view('admin.ql_banner', compact('banners'));
    }

}
