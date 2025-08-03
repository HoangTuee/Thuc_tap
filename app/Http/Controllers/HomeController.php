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
        // Lấy sản phẩm Văn Phòng, đặt tên phân trang là 'vp_page'
        $hocTapVanPhong = SanPham::where('danhmuc', 'Văn Phòng - Học Tập')
                                 ->paginate(4, ['*'], 'vp_page');

        // Lấy sản phẩm Gaming, đặt tên phân trang là 'gaming_page'
        $gamingDoHoa = SanPham::where('danhmuc', 'Gaming - Đồ họa')
                              ->paginate(4, ['*'], 'gaming_page');

        // Lấy sản phẩm Linh kiện, đặt tên phân trang là 'lk_page'
        $linhKien = SanPham::where('danhmuc', 'Linh Kiện - Phụ Kiện')
                           ->paginate(4, ['*'], 'lk_page');

        $banners = Banner::all();

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
