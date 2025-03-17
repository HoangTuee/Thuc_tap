<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banner;

class BannerController extends Controller
{
    //ql banner
    public function view_add_banner()
    {
        return view('admin.form.Add_banner');
    }
    public function add_banner(Request $request)
    {
        $request->validate([
            'anh_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lưu ảnh vào thư mục public/storage/banners
        $imageName = time() . '.' . $request->anh_banner->extension();
        $request->anh_banner->move(public_path('storage/banners'), $imageName);

        // Lưu đường dẫn vào database
        $banner = new Banner();
        $banner->anh_banner = 'storage/banners/' . $imageName;
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
        ]);
        $imageName = $request->file('anh_banner')->getClientOriginalName();
        $request->anh_banner->move(public_path('storage/banners'), $imageName);
        // Lưu đường dẫn vào database
        $banner->update([
            'anh_banner' => 'storage/banners/' . $imageName,
        ]);

        if($banner){
            return redirect()->route('qlbanner')->with('success', 'Ảnh đã được thay đổi thành công!');
        }
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
