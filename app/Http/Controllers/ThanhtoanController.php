<?php

namespace App\Http\Controllers;

use App\Models\Chitietdonhang;
use App\Models\Donhang;
use Illuminate\Http\Request;
// Sửa lại Model theo chuẩn PascalCase
use App\Models\GioHang;
use App\Models\SanPham;
// SỬA LỖI QUAN TRỌNG Ở ĐÂY: Dùng Validator của Laravel
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ThanhtoanController extends Controller
{
    public function index()
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('login', 'Đăng nhập để vào trang thanh toán');
        }

        $currentUser = Auth::user();
        $thanhtoan = GioHang::where('id_user', $currentUser->id_user)->get();

        // Nếu giỏ hàng trống thì quay về
        if ($thanhtoan->isEmpty()) {
            // Bạn nên có một route tên là 'giohang' để xử lý việc này
            return redirect()->route('giohang')->with('info', 'Giỏ hàng của bạn đang trống.');
        }

        $shipping = 30000; // Phí vận chuyển

        // Đếm số loại sản phẩm
        $loai = $thanhtoan->count();

        // Tối ưu: Gộp 2 vòng lặp thành 1
        $tongsoluong = 0;
        $tongtien = 0;
        foreach ($thanhtoan as $item) {
            $tongsoluong += $item->soluong;
            $tongtien += (($item->sanpham->giasanpham - ($item->sanpham->giasanpham * $item->sanpham->giakhuyenmai) / 100) * $item->soluong);
        }

        return view('user.thanhtoan', compact('thanhtoan', 'loai', 'shipping', 'tongsoluong', 'tongtien'));
    }

    /**
     * Xử lý và lưu đơn hàng vào database
     */
    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'required|string|max:255',
            'payment_method' => 'required|in:cod,card,wallet,bank',
            'order_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $cartItems = GioHang::with('sanpham')->where('id_user', $user->id_user)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('giohang')->with('error', 'Giỏ hàng đã trống, không thể thanh toán.');
        }

        DB::beginTransaction();
        try {
            $totalAmount = $cartItems->sum(function ($item) {
                if (empty($item->sanpham)) {
                    throw new \Exception("Sản phẩm '{$item->tensanpham}' không hợp lệ.");
                }
                $finalPrice = $item->sanpham->giasanpham - ($item->sanpham->giasanpham * $item->sanpham->giakhuyenmai / 100);
                return $finalPrice * $item->soluong;
            });

            $donHang = Donhang::create([
                'ma_don_hang' => 'DH-' . strtoupper(Str::random(8)),
                'id_user' => $user->id_user,
                'tennguoinhan' => $request->customer_name,
                'sdt_nguoinhan' => $request->customer_phone,
                'diachi_giaohang' => $request->customer_address,
                'ghichu' => $request->order_notes,
                'phuongthuc_thanhtoan' => $request->payment_method,
                'trangthai' => 'Chờ xử lý',
                'tong_thanhtien' => $totalAmount + 30000,
            ]);

            foreach ($cartItems as $item) {
                $finalPricePerItem = $item->sanpham->giasanpham - ($item->sanpham->giasanpham * $item->sanpham->giakhuyenmai / 100);

                Chitietdonhang::create([
                    'id_donhang' => $donHang->id_donhang,
                    'id_sanpham' => $item->sanpham->id_sanpham,
                    'soluong' => $item->soluong,
                    'gia' => $finalPricePerItem,
                    'thanhtien' => $finalPricePerItem * $item->soluong,
                ]);
            }

            GioHang::where('id_user', $user->id_user)->delete();
            DB::commit();

            return redirect()->route('thanhtoan.success')->with('order_code', $donHang->ma_don_hang);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi đặt hàng: ' . $e->getMessage() . ' tại dòng ' . $e->getLine() . ' trong file ' . $e->getFile());
            return redirect()->back()->with('error', 'Lỗi chi tiết: ' . $e->getMessage())->withInput();
        }
    }
}
