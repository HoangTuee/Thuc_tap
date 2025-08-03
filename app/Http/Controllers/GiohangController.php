<?php

namespace App\Http\Controllers;

use App\Models\giohang;
use App\Models\sanpham;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class GiohangController extends Controller
{
    public function add_giohang(Request $request)
    {
        $user = Auth::user();
        $sanpham = sanpham::where('tensanpham', $request->tensanpham)->first();

        if (!$sanpham) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        $giohang = giohang::where('id_user', $user->id_user)->where('tensanpham', $sanpham->tensanpham)->first();

        if ($giohang) {
            $giohang->soluong += 1;
            $giohang->save();
        } else {
            GioHang::create([
                'id_user' => $user->id_user,
                'tensanpham' => $sanpham->tensanpham,
                'soluong' => 1,
            ]);
        }
        return redirect()->route('giohang')->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('login', 'Đăng nhập để vào giỏ hàng của bạn!');
        }

        $userId = Auth::user()->id_user;

        // Luôn dùng 'with' để tải trước thông tin sản phẩm, tối ưu hiệu năng
        $giohangItems = Giohang::with('sanpham')->where('id_user', $userId)->get();

        return view('user.giohang', ['giohang' => $giohangItems]);
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng qua AJAX.
     * Đây là hàm duy nhất xử lý việc tăng/giảm số lượng.
     */
    public function update(Request $request, $id_giohang)
    {
        // 1. Validate dữ liệu gửi lên
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        try {
            $userId = Auth::user()->id_user;

            // 2. Tìm và cập nhật sản phẩm trong giỏ hàng một cách an toàn
            $giohangItem = Giohang::where('id_giohang', $id_giohang)
                ->where('id_user', $userId)
                ->firstOrFail(); // Tự động báo lỗi 404 nếu không tìm thấy

            $giohangItem->soluong = $validated['quantity'];
            $giohangItem->save();

            // 3. Lấy lại toàn bộ giỏ hàng và tính toán lại với giá trị ĐÚNG
            $allCartItems = Giohang::with('sanpham')->where('id_user', $userId)->get();

            $subtotal = $allCartItems->sum(function ($item) {
                // An toàn nếu sản phẩm trong giỏ hàng bị lỗi (đã bị xóa khỏi bảng sanpham)
                if (!$item->sanpham) return 0;

                // SỬA LỖI CHÍ MẠNG: Dùng $item->sanpham->giasanpham và tính cả khuyến mãi
                $finalPrice = $item->sanpham->giasanpham - ($item->sanpham->giasanpham * $item->sanpham->giakhuyenmai / 100);
                return $finalPrice * $item->soluong;
            });

            $shipping = 30000; // Phí ship cố định
            $total = $subtotal + $shipping;

            // 4. Trả về phản hồi JSON với dữ liệu đã được tính toán chính xác
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật số lượng thành công!',
                'data' => [
                    'subtotal' => $subtotal,
                    'total' => $total,
                    'shipping' => $shipping,
                    'discount' => 0, // Tạm thời, bạn có thể thêm logic coupon ở đây
                    'cart_count' => $allCartItems->sum('soluong') // Tổng số lượng tất cả sản phẩm
                ]
            ]);
        } catch (ModelNotFoundException  $e) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ!'], 404);
        } catch (\Exception $e) {
            Log::error("Lỗi cập nhật giỏ hàng: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã có lỗi từ server!'], 500);
        }
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng.
     */
    public function remove($id_giohang)
    {
        try {
            $userId = Auth::user()->id_user;
            $giohangItem = Giohang::where('id_giohang', $id_giohang)
                ->where('id_user', $userId)
                ->firstOrFail();

            $giohangItem->delete();
            return redirect()->route('giohang')->with('success', 'Xóa sản phẩm thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể xóa sản phẩm, vui lòng thử lại!');
        }
    }
}
