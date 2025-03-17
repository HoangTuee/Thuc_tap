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
        $hocTapVanPhong = sanpham::where('danhmuc', 'HỌC TẬP - VĂN PHÒNG')->paginate(4);
        $gamingDoHoa = sanpham::where('danhmuc', 'GAMING - ĐỒ HỌA')->paginate(4);
        $MacBook = sanpham::where('danhmuc', 'LAPTOP MACBOOK')->paginate(4);
        $banners = banner::all();
        return view('index', compact('hocTapVanPhong', 'gamingDoHoa', 'MacBook', 'banners'));
    }
}
