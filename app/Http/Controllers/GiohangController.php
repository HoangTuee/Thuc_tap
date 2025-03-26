<?php

namespace App\Http\Controllers;

use App\Models\giohang;
use App\Models\sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiohangController extends Controller
{
    public function add_giohang(Request $request)
    {
        $user = Auth::user();
        $sanpham = sanpham::where('tensanpham', $request->tensanpham)->first();
        $giohang = giohang::where('id_user', $user->id_user)->where('tensanpham', $sanpham->tensanpham)->first();

        if ($giohang) {
            $giohang->soluong += 1;
            $giohang->save();
        } else {
            GioHang::create([
                'id_user' => $user->id_user,
                'tensanpham' => $sanpham->tensanpham,
                'soluong' => 1,
                'giasanpham' => ($sanpham->giasanpham - $sanpham->giasanpham * $sanpham->giakhuyenmai / 100),
            ]);
        }
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    public function giohang()
    {
        if(!auth::check()){
            return redirect()->route('login')->with('login','Đăng nhập để vào giỏ hàng của bạn !');
        }
        $giohang = GioHang::where('id_user',auth()->user()->id_user)->get();
        return view('user.giohang', compact('giohang'));
    }
    public function delete_giohang($id)
    {
        $giohang = GioHang::find($id);
        if ($giohang && $giohang->id_user == Auth::id()) {
            $giohang->delete();
            return back()->with('success', 'Xóa sản phẩm thành công!');
        }

        return back()->with('error', 'Không thể xóa sản phẩm!');
    }
}
