<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\sanpham;
use App\Models\chitietsanpham;
use Illuminate\Http\Request;

class ChitietsanphamController extends Controller
{
    //Quan ly chi tiet san pham
    public function qlchitiet()
    {
        $chitiets = chitietsanpham::orderBy('id_chitiet', 'DESC')->paginate(4);
        return view('admin.ql_chitiet', compact('chitiets'));
    }
    public function chitiet($tensanpham)
    {
        $sanpham = sanpham::where('tensanpham', $tensanpham)->first();
        $chitiet = chitietsanpham::where('tensanpham', $tensanpham)->first();
        if (!$sanpham || !$chitiet) {
            return abort(404);
        }
        return view('user.chitietsanpham', compact('sanpham', 'chitiet'));
    }

    public function view_add_chitiet($tensanpham)
    {
        return view('admin.form.Add_chitietsanpham', compact('tensanpham'));
    }

    public function add_chitiet(Request $request)
    {
        $request->validate([
            'tensanpham' => 'required|exists:sanpham,tensanpham',
            'cauhinh_sanpham' => 'nullable|string|max:100',
            'tinhtrang_sanpham' => 'nullable|string|max:100',
            'anhchitiet1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anhchitiet2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anhchitiet3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anhchitiet4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image1 = null;
        $image2 = null;
        $image3 = null;
        $image4 = null;
        if ($request->hasFile('anhchitiet1')) {
            $image1 = $request->file("anhchitiet1")->getClientOriginalName();
            $request->anhchitiet1->move(public_path('storage/chitietsanpham'), $image1);
        }

        if ($request->hasFile('anhchitiet2')) {
            $image2 = $request->file("anhchitiet2")->getClientOriginalName();
            $request->anhchitiet2->move(public_path('storage/chitietsanpham'), $image2);
        }

        if ($request->hasFile('anhchitiet3')) {
            $image3 = $request->file("anhchitiet3")->getClientOriginalName();
            $request->anhchitiet3->move(public_path('storage/chitietsanpham'), $image3);
        }

        if ($request->hasFile('anhchitiet4')) {
            $image4 = $request->file("anhchitiet4")->getClientOriginalName();
            $request->anhchitiet4->move(public_path('storage/chitietsanpham'), $image4);
        }

        ChiTietSanPham::create([
            'tensanpham' => $request->tensanpham,
            'cauhinh_sanpham' => $request->cauhinh_sanpham ?? '',
            'tinhtrang_sanpham' => $request->tinhtrang_sanpham,
            'anhchitiet1' => $image1 ? 'storage/chitietsanpham/' . $image1 : null,
            'anhchitiet2' => $image2 ? 'storage/chitietsanpham/' . $image2 : null,
            'anhchitiet3' => $image3 ? 'storage/chitietsanpham/' . $image3 : null,
            'anhchitiet4' => $image4 ? 'storage/chitietsanpham/' . $image4 : null,
        ]);
        return redirect()->route('qlchitiet')->with('success', 'Thêm chi tiết sản phẩm thành công!');
    }

    public function view_edit_chitiet($id_chitiet)
    {
        $chitiet = chitietsanpham::findOrFail($id_chitiet);
        return view('admin.form.Edit_chitietsanpham', compact('chitiet'));
    }

    public function edit_chitiet(Request $request, $id_chitiet)
    {
        $request->validate([
            'tensanpham' => 'required|string',
            'cauhinh_sanpham' => 'nullable|string|max:100',
            'tinhtrang_sanpham' => 'required|string|max:100',
            'anhchitiet1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anhchitiet2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anhchitiet3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anhchitiet4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $chitiet = chitietsanpham::findOrFail($id_chitiet);
        $chitiet->tensanpham = $request->tensanpham;
        $chitiet->cauhinh_sanpham = $request->cauhinh_sanpham ?? '';
        $chitiet->tinhtrang_sanpham = $request->tinhtrang_sanpham;
        if ($request->hasFile('anhchitiet1')) {
            $image1 = $request->file("anhchitiet1")->getClientOriginalName();
            $request->anhchitiet1->move(public_path('storage/chitietsanpham'), $image1);
            $chitiet->anhchitiet1 = 'storage/chitietsanpham/' . $image1;
        }

        if ($request->hasFile('anhchitiet2')) {
            $image2 = $request->file("anhchitiet2")->getClientOriginalName();
            $request->anhchitiet2->move(public_path('storage/chitietsanpham'), $image2);
            $chitiet->anhchitiet2 = 'storage/chitietsanpham/' . $image2;
        }

        if ($request->hasFile('anhchitiet3')) {
            $image3 = $request->file("anhchitiet3")->getClientOriginalName();
            $request->anhchitiet3->move(public_path('storage/chitietsanpham'), $image3);
            $chitiet->anhchitiet3 = 'storage/chitietsanpham/' . $image3;
        }

        if ($request->hasFile('anhchitiet4')) {
            $image4 = $request->file("anhchitiet4")->getClientOriginalName();
            $request->anhchitiet4->move(public_path('storage/chitietsanpham'), $image4);
            $chitiet->anhchitiet4 = 'storage/chitietsanpham/' . $image4;
        }

        $chitiet->save();
        return redirect()->route('qlchitiet')->with('success', 'Sua chi tiet thanh cong');
    }

    public function delete_chitiet($id_chitiet)
    {
        chitietsanpham::destroy($id_chitiet);
        return redirect()->route('qlchitiet')->with('success', 'Xoa chi tiet thanh cong');
    }

    //quan ly chi tiet tung san pham

    public function qlchitietsanpham(Request $request, $tensanpham)
    {
        $chitiet = chitietsanpham::where('tensanpham', $tensanpham)->first();
        if (!$chitiet) {
            return redirect()->route('view_add_chitiet', ['tensanpham' => $tensanpham]);
        }
        $sanpham = sanpham::where('tensanpham', $tensanpham)->firstOrFail();
        return view('admin.ql_chitietsanpham', compact('chitiet', 'sanpham'));
    }
    public function timKiem(Request $request)
    {
        $keyword = $request->input('keyword');

        $chitiets = ChiTietSanPham::where('tensanpham', 'LIKE', "%{$keyword}%")
            ->orWhere('cauhinh_sanpham', 'LIKE', "%{$keyword}%")
            ->orWhere('tinhtrang_sanpham', 'LIKE', "%{$keyword}%")
            ->paginate(10);

        return view('admin.ql_chitiet', compact('chitiets'));
    }
}
