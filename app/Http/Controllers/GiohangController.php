<?php

namespace App\Http\Controllers;

use App\Models\giohang;
use App\Models\sanpham;
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
                'giasanpham' => ($sanpham->giasanpham - $sanpham->giasanpham * $sanpham->giakhuyenmai / 100),
            ]);
        }
        return redirect()->route('giohang')->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    public function giohang()
    {
        if (!auth::check()) {
            return redirect()->route('login')->with('login', 'Đăng nhập để vào giỏ hàng của bạn !');
        }
        $giohang = GioHang::where('id_user', auth()->user()->id_user)->get();
        return view('user.giohang', compact('giohang'));
    }

    public function delete_giohang($id)
    {
        $giohang = GioHang::find($id);
        if ($giohang && $giohang->id_user == Auth::user()->id_user) {
            $giohang->delete();
            return redirect()->route('giohang')->with('success delete', 'Xóa sản phẩm thành công!');
        }

        return back()->with('error', 'Không thể xóa sản phẩm!');
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng qua AJAX
     */
    public function updateQuantity(Request $request, $id)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'quantity' => 'required|integer|min:1|max:99'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng không hợp lệ!',
                    'errors' => $validator->errors()
                ], 400);
            }

            // Tìm sản phẩm trong giỏ hàng
            $giohang = GioHang::where('id_giohang', $id)
                ->where('id_user', Auth::user()->id_user)
                ->first();

            if (!$giohang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
                ], 404);
            }

            // Cập nhật số lượng
            $giohang->soluong = $request->quantity;
            $giohang->save();

            // Tính toán lại tổng tiền
            $allCartItems = GioHang::where('id_user', Auth::user()->id_user)->get();
            $subtotal = $allCartItems->sum(function ($item) {
                return $item->giasanpham * $item->soluong;
            });

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật số lượng thành công!',
                'data' => [
                    'item_total' => $giohang->giasanpham * $giohang->soluong,
                    'subtotal' => $subtotal,
                    'total' => $subtotal + 30000, // Phí ship cố định
                    'quantity' => $giohang->soluong
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật giỏ hàng!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function setQuantity(Request $request, $id_giohang)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1|max:99', // 'quantity' là key JS gửi đi, max:99 nếu muốn giới hạn
        ]);

        try {
            $giohang = GioHang::where('id_giohang', $id_giohang)
                // Quan trọng: đảm bảo chỉ user hiện tại mới sửa được giỏ hàng của họ
                ->where('id_user', Auth::user()->id_user) // Giả sử user_id được lưu là id_user
                ->first();

            if (!$giohang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!'
                ], 404);
            }

            $giohang->soluong = $validatedData['quantity'];
            $giohang->save();

            // Gọi hàm getCartSummary của bạn để trả về toàn bộ thông tin giỏ hàng đã cập nhật
            // return $this->getCartSummary($giohang); // Đảm bảo $giohang->id_user tồn tại hoặc bạn truyền user ID
            // Hoặc nếu getCartSummary cần user ID, bạn có thể làm như sau:
            return $this->getCartSummaryAfterUpdate($giohang->id_user); // Tạo hàm mới hoặc điều chỉnh getCartSummary

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error in setQuantity: ' . $e->getMessage()); // Ghi log lỗi
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật số lượng!'
            ], 500);
        }
    }

    /**
     * Lấy thông tin tổng hợp giỏ hàng cho user.
     * Hàm này cần được điều chỉnh để phù hợp với cách bạn cấu trúc dữ liệu trả về
     * mà JavaScript mong đợi trong data.data.
     */
    protected function getCartSummaryAfterUpdate($userId) // Thay vì nhận $giohang item
    {
        // Lấy tất cả các mục trong giỏ hàng của người dùng
        $userCartItems = GioHang::where('id_user', $userId)->get(); // Hoặc id_khachhang

        if ($userCartItems->isEmpty() && $userId != null) { // Kiểm tra nếu user có giỏ hàng trống
            // Nếu bạn muốn trả về cấu trúc rỗng cho giỏ hàng trống
            return response()->json([
                'success' => true, // Hoặc false tùy theo logic bạn muốn khi giỏ hàng trống sau update
                'message' => 'Giỏ hàng trống hoặc sản phẩm vừa bị xóa.',
                'data' => [
                    'item_id' => null, // Không có item cụ thể để trỏ tới
                    'item_total_price' => 0,
                    'subtotal' => 0,
                    'shipping' => 30000, // Hoặc giá trị mặc định
                    'discount' => 0,
                    'total' => 30000, // Chỉ còn phí ship nếu giỏ trống
                    'cart_count' => 0,
                    'new_quantity_of_item' => 0,
                ]
            ]);
        } else if ($userCartItems->isEmpty() && $userId == null) {
            // Xử lý trường hợp user không được xác định
            return response()->json(['success' => false, 'message' => 'Người dùng không xác định.'], 401);
        }


        $subtotal = $userCartItems->sum(function ($item) {
            return $item->giasanpham * $item->soluong;
        });

        $shipping = 30000; // Lấy từ config hoặc logic của bạn
        $discount = session('applied_coupon')['discount_amount'] ?? 0; // Ví dụ lấy từ session
        $total = $subtotal + $shipping - $discount;
        $cart_count = $userCartItems->count(); // Tổng số loại sản phẩm

        // Tìm item vừa được cập nhật để trả về chi tiết của nó nếu cần (có thể không cần thiết nếu chỉ cập nhật tổng)
        // $updatedItemDetails = $userCartItems->firstWhere('id_giohang', $recentlyUpdatedItemId);

        return response()->json([
            'success' => true,
            'message' => 'Giỏ hàng đã được cập nhật.',
            'data' => [
                // Nếu bạn cần thông tin của một item cụ thể vừa được cập nhật, bạn cần cách để xác định nó ở đây
                // Ví dụ, bạn có thể không cần 'item_id' và 'item_total_price' ở cấp độ này nữa
                // mà JS sẽ tự cập nhật dựa trên input.value và data-price
                // Tuy nhiên, để đồng bộ hoàn toàn, server nên trả về new_quantity của item đó.
                // 'item_id' => $recentlyUpdatedItemId, // Cần truyền ID item vừa update vào đây
                // 'new_quantity_of_item' => $soluong_moi_cua_item_do,
                // 'item_total_price' => $tong_tien_cua_item_do,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'discount' => $discount,
                'total' => $total,
                'cart_count' => $cart_count,
            ]
        ]);
    }
}
