<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Sửa lại Model theo chuẩn PascalCase
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\DonHang;
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
            $tongtien += ($item->soluong * $item->giasanpham);
        }

        return view('user.thanhtoan', compact('thanhtoan', 'loai', 'shipping', 'tongsoluong', 'tongtien'));
    }

    /**
     * Xử lý và lưu đơn hàng vào database
     */
    public function process(Request $request)
    {
        // 1. Validation
        $rules = [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'required|string|max:255',
            'payment_method' => 'required|in:cod,card,wallet,bank',
            'order_notes' => 'nullable|string', // Thêm validation cho ghi chú
        ];

        // Sử dụng Validator Facade đã được import đúng
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $cartItems = GioHang::where('id_user', $user->id_user)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('giohang')->with('error', 'Giỏ hàng trống, không thể thanh toán.');
        }

        // Bắt đầu transaction để đảm bảo an toàn dữ liệu
        DB::beginTransaction();
        try {
            // Tạo một mã đơn hàng chung cho lần thanh toán này
            $commonOrderCode = 'DH-' . strtoupper(Str::random(8));

            // Lặp qua từng sản phẩm trong giỏ hàng
            foreach ($cartItems as $item) {
                // Dùng tensanpham từ giỏ hàng để tìm sản phẩm trong bảng sanpham
                $product = SanPham::where('tensanpham', $item->tensanpham)->first();

                // Nếu vì lý do nào đó sản phẩm không còn tồn tại, hủy đơn hàng
                if (!$product) {
                    // Dừng và báo lỗi ngay lập tức
                    throw new \Exception("Sản phẩm '{$item->tensanpham}' không còn tồn tại trong cửa hàng.");
                }

                // Tạo một dòng mới trong bảng DonHang
                DonHang::create([
                    'ma_don_hang_chung' => $commonOrderCode,
                    'id_user' => $user->id_user,
                    'tennguoinhan' => $request->customer_name,
                    'sdt_nguoinhan' => $request->customer_phone,
                    'diachi_giaohang' => $request->customer_address,
                    'ghichu' => $request->order_notes,
                    'phuongthuc_thanhtoan' => $request->payment_method,
                    'trangthai' => 'Chờ xử lý',

                    // Lấy thông tin từ sản phẩm và giỏ hàng
                    'id_sanpham' => $product->id_sanpham,
                    'tensanpham' => $item->tensanpham,
                    'soluong' => $item->soluong,
                    'gia' => $item->giasanpham,
                    'thanhtien' => $item->giasanpham * $item->soluong,
                ]);
            }

            // Xóa giỏ hàng sau khi đã đặt hàng thành công
            GioHang::where('id_user', $user->id_user)->delete();

            // Nếu mọi thứ ổn, lưu thay đổi vào database
            DB::commit();

            // Giả sử bạn có route tên 'thanhtoan.success' để hiển thị trang báo thành công
            return redirect()->route('thanhtoan.success')->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            // Nếu có lỗi, hoàn tác tất cả các thay đổi
            DB::rollBack();
            // Ghi lại lỗi để debug
            Log::error('Lỗi đặt hàng: ' . $e->getMessage());
            // Trả về trang thanh toán với thông báo lỗi
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }
}
