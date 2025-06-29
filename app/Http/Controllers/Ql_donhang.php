<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Support\Facades\DB;

class Ql_donhang extends Controller
{
    /**
     * Hiển thị danh sách các đơn hàng đã được nhóm lại.
     */
    public function index(Request $request)
    {
        $query = DonHang::query()
            ->select(
                'ma_don_hang_chung',
                'tennguoinhan',
                'sdt_nguoinhan',
                'phuongthuc_thanhtoan',
                'trangthai',
                'created_at',
                DB::raw('SUM(thanhtien) as tong_tien')
            )
            ->groupBy('ma_don_hang_chung', 'tennguoinhan', 'sdt_nguoinhan', 'phuongthuc_thanhtoan', 'trangthai', 'created_at')
            ->orderBy('created_at', 'desc');

        // Xử lý tìm kiếm
        if ($keyword = $request->input('keyword')) {
            $query->where(function($q) use ($keyword) {
                $q->where('ma_don_hang_chung', 'like', "%{$keyword}%")
                  ->orWhere('tennguoinhan', 'like', "%{$keyword}%")
                  ->orWhere('sdt_nguoinhan', 'like', "%{$keyword}%");
            });
        }

        // Xử lý lọc theo trạng thái
        if ($status = $request->input('status')) {
            if ($status != 'all') {
                 $query->where('trangthai', $status);
            }
        }

        $donhangs = $query->paginate(10); // Phân trang, 10 đơn hàng mỗi trang

        return view('admin.ql_donhang', compact('donhangs'));
    }

    /**
     * Hiển thị chi tiết một đơn hàng.
     */
    public function show($ma_don_hang_chung)
    {
        $order_items = DonHang::where('ma_don_hang_chung', $ma_don_hang_chung)->get();

        if ($order_items->isEmpty()) {
            return redirect()->route('admin.donhang.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Lấy thông tin chung từ sản phẩm đầu tiên
        $order_info = $order_items->first();

        // Tính toán lại tổng tiền để hiển thị
        $total = $order_items->sum('thanhtien');
        $shipping = 30000; // Giả sử phí ship cố định
        $grand_total = $total + $shipping;


        return view('admin.ql_chitietdonhang', compact('order_items', 'order_info', 'total', 'shipping', 'grand_total'));
    }

    /**
     * Cập nhật trạng thái đơn hàng.
     */
    public function updateStatus(Request $request, $ma_don_hang_chung)
    {
        $request->validate([
            'trangthai' => 'required|string|in:Chờ xử lý,Đang giao,Hoàn thành,Đã hủy',
        ]);

        DonHang::where('ma_don_hang_chung', $ma_don_hang_chung)
               ->update(['trangthai' => $request->trangthai]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    /**
     * Xóa một đơn hàng (tất cả các mục liên quan).
     */
    public function destroy($ma_don_hang_chung)
    {
        DonHang::where('ma_don_hang_chung', $ma_don_hang_chung)->delete();

        return redirect()->route('ql_donnhang')->with('success', 'Đã xóa đơn hàng thành công.');
    }
}
