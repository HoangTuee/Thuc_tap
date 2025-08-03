<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\chitietsanpham;
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
            'giakhuyenmai' => 'nullable|integer|min:0',
            'thongso_sanpham' => 'nullable|string|max:100',
            'danhmuc' => 'required|string|max:100',
            'hangsanpham' => 'required|string|max:100',
        ]);
        $imgName = $request->file("anhsanpham");
        $imgName = $imgName->getClientOriginalName();
        $request->anhsanpham->move(public_path('storage/sanpham'), $imgName);

        $sanpham = new SanPham();
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->giasanpham = $request->giasanpham;
        $sanpham->anhsanpham = 'storage/sanpham/' . $imgName;
        $sanpham->giakhuyenmai = $request->giakhuyenmai ?? '0';
        $sanpham->thongso_sanpham = $request->thongso_sanpham ?? '';
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
            'giakhuyenmai' => 'nullable|integer|min:0',
            'thongso_sanpham' => 'nullable|string|max:100',
            'danhmuc' => 'required|string|max:100',
            'hangsanpham' => 'required|string|max:100',
        ]);

        $sanpham = SanPham::findOrFail($id);
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->giasanpham = $request->giasanpham;
        $sanpham->giakhuyenmai = $request->giakhuyenmai ?? '0';
        $sanpham->thongso_sanpham = $request->thongso_sanpham ?? '';
        $sanpham->danhmuc = $request->danhmuc;
        $sanpham->hangsanpham = $request->hangsanpham;

        if ($request->hasFile('anhsanpham')) {
            $imgName = $request->file("anhsanpham");
            $imgName = $imgName->getClientOriginalName();
            $request->anhsanpham->move(public_path('storage/sanpham'), $imgName);
            $sanpham->anhsanpham = 'storage/sanpham/' . $imgName;
        }
        $sanpham->save();
        return redirect()->route('sanpham')->with('success', 'Sua san pham thanh cong');
    }

    public function delete_sanpham(Request $request, $id)
    {
        sanpham::destroy($id);
        return redirect()->route('sanpham')->with('success', 'Xoa san pham thanh cong');
    }

    public function sanpham()
    {
        $sanphams = sanpham::orderBy('id_sanpham', 'DESC')->paginate(4);
        $sanphamHasDetail = chitietsanpham::pluck('tensanpham')->toArray();
        return view('admin/ql_sanpham', compact('sanphams', 'sanphamHasDetail'));
    }

    //tim kiem cua khach hang
    public function search(Request $request)
    {
        // Lấy giá trị tìm kiếm từ request
        $search = $request->input('search-header');

        // Kiểm tra nếu giá trị tìm kiếm không rỗng
        if ($search) {
            // Tìm kiếm sản phẩm theo tên và thông số và phân trang
            $sanphams = sanpham::where('tensanpham', 'LIKE', '%' . $search . '%')
                ->orWhere('thongso_sanpham', 'LIKE', '%' . $search . '%')
                ->paginate(4);
        } else {
            // Nếu không có giá trị tìm kiếm, trả về tất cả sản phẩm
            $sanphams = sanpham::paginate(4);
        }

        if ($sanphams == null) {
            return redirect()->route('search')->with('success', 'Sản phẩm không tồn tại');
        } else {
            return view('user.timkiem', compact('sanphams', 'search'));
        }
    }

    public function sanphams(Request $request)
    {
        $banners = banner::all();
        $sanphams = sanpham::paginate(8);
        return view('user.sanpham', compact('sanphams', 'banners'));
    }

    //Tim kiem cua admin
    public function timKiem(Request $request)
    {
        $keyword = $request->input('keyword');
        $sanphamHasDetail = chitietsanpham::pluck('tensanpham')->toArray();
        $sanphams = SanPham::where('tensanpham', 'LIKE', "%{$keyword}%")
            ->orWhere('hangsanpham', 'LIKE', "%{$keyword}%")
            ->orWhere('danhmuc', 'LIKE', "%{$keyword}%")
            ->paginate(10);

        return view('admin/ql_sanpham', compact('sanphams', 'sanphamHasDetail'));
    }
}
