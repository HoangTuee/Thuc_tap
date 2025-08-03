<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Support\Facades\DB;

class Ql_donhang extends Controller
{
    public function index(Request $request)
    {
        // Bắt đầu một query mới, sắp xếp theo ngày tạo mới nhất
        $query = DonHang::query()->orderBy('created_at', 'desc');

        // Lọc theo từ khóa (mã đơn hàng, tên hoặc SĐT người nhận)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('ma_don_hang', 'like', "%{$keyword}%")
                    ->orWhere('tennguoinhan', 'like', "%{$keyword}%")
                    ->orWhere('sdt_nguoinhan', 'like', "%{$keyword}%");
            });
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('trangthai', $request->status);
        }

        // Lấy kết quả đã phân trang
        $donhangs = $query->paginate(15);

        return view('admin.ql_donhang', compact('donhangs'));
    }

    /**
     * Hiển thị chi tiết của một đơn hàng.
     */
    public function show($id_donhang)
    {
        // Dùng with() để tải sẵn chi tiết đơn hàng và thông tin sản phẩm liên quan
        // Giúp tối ưu hiệu năng, tránh query N+1
        $donhang = DonHang::with('chiTietDonHangs.sanpham')->findOrFail($id_donhang);

        return view('admin.ql_chitietdonhang', compact('donhang'));
    }

    /**
     * Cập nhật trạng thái của một đơn hàng.
     */
    public function updateStatus(Request $request, $id_donhang)
    {
        $request->validate([
            'trangthai' => 'required|in:Chờ xử lý,Đang giao,Hoàn thành,Đã hủy'
        ]);

        $donhang = DonHang::findOrFail($id_donhang);
        $donhang->trangthai = $request->trangthai;
        $donhang->save();

        return redirect()->route('admin.donhang.show', $donhang->id_donhang)
            ->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    /**
     * Xóa một đơn hàng.
     */
    public function destroy($id_donhang)
    {
        $donhang = DonHang::findOrFail($id_donhang);

        // Giả sử bạn đã thiết lập onDelete('cascade') trong migration
        // Nếu không, bạn cần xóa các chi tiết đơn hàng liên quan trước
        // $donhang->chiTietDonHangs()->delete();
        $donhang->delete();

        return redirect()->route('admin.donhang.index')
            ->with('success', 'Xóa đơn hàng thành công!');
    }
}
