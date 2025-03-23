<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\sanpham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $sanphams = sanpham::all();
        // $sanphams = sanpham::paginate(4);
        $hocTapVanPhong = sanpham::where('danhmuc', 'Văn Phòng - Học Tập')->paginate(4);
        $gamingDoHoa = sanpham::where('danhmuc', 'Gaming - Đồ Họa')->paginate(4);
        $linhKien = sanpham::where('danhmuc', 'Link Kiện - Phụ Kiện')->paginate(4);
        $banners = banner::all();
        return view('index', compact('hocTapVanPhong', 'gamingDoHoa', 'linhKien', 'banners'));
    }
}
