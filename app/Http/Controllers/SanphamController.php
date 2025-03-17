<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use Illuminate\Http\Request;

class SanphamController extends Controller
{
    public function view_add_sanpham()
    {
        return view('admin.form.Add_sanpham');
    }

    public function add_sanpham(Request $request)
    {
        $request->validate([
            'tensanpham' => 'required|string|max:100|unique:sanpham,tensanpham',
            'giasanpham' => 'required|integer|min:0',
            'anhsanpham' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'giabandau' => 'required|integer|min:0',
            'giakhuyenmai' => 'required|integer|min:0',
            'thongso_sanpham' => 'required|string|max:100',
            'danhmuc' => 'required|string|max:100',
            'hangsanpham' => 'required|string|max:100',
        ]);
        $imgName = time() . '.' . $request->anhsanpham->extension();
        $request->anhsanpham->move(public_path('storage/sanpham'), $imgName);

        $sanpham = new SanPham();
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->giasanpham = $request->giasanpham;
        $sanpham->anhsanpham = 'storage/sanpham/' . $imgName;
        $sanpham->giabandau = $request->giabandau;
        $sanpham->giakhuyenmai = $request->giakhuyenmai;
        $sanpham->thongso_sanpham = $request->thongso_sanpham;
        $sanpham->danhmuc = $request->danhmuc;
        $sanpham->hangsanpham = $request->hangsanpham;
        $sanpham->save();

        return redirect()->route('sanpham')->with('success', 'Them san pham thanh cong');
    }

    public function view_edit_sanpham($id)
    {
        $sanpham = sanpham::findOrFail($id);
        return view('admin.form.Edit_sanpham', compact('sanpham'));
    }

    public function edit_sanpham(Request $request, $id)
    {
        $request->validate([
            'tensanpham' => 'required|string|max:100|unique:sanpham,tensanpham,' . $id . ',id_sanpham',
            'giasanpham' => 'required|integer|min:0',
            'anhsanpham' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'giabandau' => 'required|integer|min:0',
            'giakhuyenmai' => 'required|integer|min:0',
            'thongso_sanpham' => 'required|string|max:100',
            'danhmuc' => 'required|string|max:100',
            'hangsanpham' => 'required|string|max:100',
        ]);

        $sanpham = SanPham::findOrFail($id);
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->giasanpham = $request->giasanpham;
        $sanpham->giabandau = $request->giabandau;
        $sanpham->giakhuyenmai = $request->giakhuyenmai;
        $sanpham->thongso_sanpham = $request->thongso_sanpham;
        $sanpham->danhmuc = $request->danhmuc;
        $sanpham->hangsanpham = $request->hangsanpham;

        if ($request->hasFile('anhsanpham')) {
            $imgName = time() . '.' . $request->anhsanpham->extension();
            $request->anhsanpham->move(public_path('storage/sanpham'), $imgName);
            $sanpham->anhsanpham = 'storage/sanpham/' . $imgName;
        }
        $sanpham->save();
        return redirect()->route('sanpham')->with('success', 'Sua san pham thanh cong');
    }

    public function delete_sanpham(Request $request, $id){
        sanpham::destroy($id);
        return redirect()->route('sanpham')->with('success', 'Xoa san pham thanh cong');
    }

    public function sanpham()
    {
        $sanphams = sanpham::paginate(5);
        return view('admin/ql_sanpham', compact('sanphams'));
    }

}
