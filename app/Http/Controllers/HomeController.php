<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\sanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class HomeController extends Controller
{
    public function index()
    {
        // $sanphams = sanpham::all();
        // $sanphams = sanpham::paginate(4);
        $hocTapVanPhong = sanpham::where('danhmuc', 'Văn Phòng - Học Tập')->paginate(4);
        $gamingDoHoa = sanpham::where('danhmuc', 'Gaming - Đồ Họa')->paginate(4);
        $linhKien = sanpham::where('danhmuc', 'Linh Kiện - Phụ Kiện')->paginate(4);
        $banners = banner::all();
        return view('index', compact('hocTapVanPhong', 'gamingDoHoa', 'linhKien', 'banners'));
    }

    public function testmail (){
        Mail::to('hoangtuee3112@gmail.com')->send(new TestMail());
        return 'Success !';
    }

    public function view_quenmk(){
        return view('login.Quenmk');
    }
}
