<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChitietsanphamController;
use App\Http\Controllers\GiohangController;
use App\Http\Controllers\HoadonController;
use App\Http\Controllers\Ql_donhang;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\ThanhtoanController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
//Dang nhap
Route::get('/login', function () {
    return view('login.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/signup', [LoginController::class, 'signup'])->name('signup');
Route::post('/add_signup', [LoginController::class, 'add_signup'])->name('addsignup');

//User
Route::get('/tintuc', [UserController::class, 'tintuc'])->name('tintuc');
Route::get('/laptopnew', [UserController::class, 'laptopnew'])->name('laptopnew');
Route::get('/khuyenmai', [UserController::class, 'khuyenmai'])->name('khuyenmai');

//Chi tiet san pham
Route::get('/chitietsanpham/{tensanpham}', [ChitietsanphamController::class, 'chitiet'])->name('chitiet');

//gio hang
Route::get('/giohang', [GiohangController::class, 'index'])->name('giohang');
Route::post('/add_giohang', [GiohangController::class, 'add_giohang'])->name('addgiohang');
Route::delete('/delete_giohang/{id}', [GiohangController::class, 'remove'])->name('deletegiohang');
Route::put('/cart/update/{id_giohang}', [GioHangController::class, 'update'])->name('cart.setQuantity');

//thanh toán
Route::get('/checkout', [ThanhtoanController::class, 'index'])->name('checkout');
Route::post('/checkout', [ThanhtoanController::class, 'process'])->name('checkout.process');
Route::get('/dat-hang-thanh-cong', function () {
    return view('user.thanhtoan_success'); // Tạo view này để báo thành công
})->name('thanhtoan.success');

//Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    //ql san pham
    Route::get('admin/sanpham', [SanphamController::class, 'sanpham'])->name('sanpham');
    Route::get('admin/view_add_sanpham', [SanphamController::class, 'view_add_sanpham'])->name('view_add_sanpham');
    Route::post('admin/add_sanpham', [SanphamController::class, 'add_sanpham'])->name('add_sanpham');
    Route::get('admin/{id}/view_edit_sanpham', [SanphamController::class, 'view_edit_sanpham'])->name('view_edit_sanpham');
    Route::put('admin/{id}/edit_sanpham', [SanphamController::class, 'edit_sanpham'])->name('edit_sanpham');
    Route::delete('admin/{id}/delete_sanpham', [SanphamController::class, 'delete_sanpham'])->name('delete_sanpham');
    Route::get('/admin/sanpham/timkiem', [SanPhamController::class, 'timKiem'])->name('timkiem_sanpham');


    //ql tai khoan
    Route::get('admin/qladmin', [AdminController::class, 'qladmin'])->name('qladmin');
    Route::get('admin/adduser', [AdminController::class, 'view_add_user'])->name('view_add_user');
    Route::post('admin/users', [AdminController::class, 'add_user'])->name('users.store');
    Route::get('admin/{id}/edituser', [AdminController::class, 'view_edit_user'])->name('view_edit_user');
    Route::put('admin/{id}/edituser', [AdminController::class, 'edit_user'])->name('edit_user');
    Route::delete('admin/{id}/delete_user', [AdminController::class, 'delete_user'])->name('delete_user');
    Route::get('/admin/user/timkiem', [AdminController::class, 'timKiem'])->name('timkiem_user');

    //ql banner
    Route::get('admin/qlbanner', [BannerController::class, 'qlbanner'])->name('qlbanner');
    Route::get('admin/view_add_banner', [BannerController::class, 'view_add_banner'])->name('view_add_banner');
    Route::post('admin/add_banner', [BannerController::class, 'add_banner'])->name('add_banner');
    Route::get('admin/{id}/view_edit_banner', [BannerController::class, 'view_edit_banner'])->name('view_edit_banner');
    Route::put('admin/{banner}/edit_banner', [BannerController::class, 'edit_banner'])->name('edit_banner');
    Route::delete('admin/{id}', [BannerController::class, 'delete_banner'])->name('delete_banner');

    //ql chi tiet
    Route::get('admin/qlchitiet', [ChitietsanphamController::class, 'qlchitiet'])->name('qlchitiet');
    Route::get('admin/{tensanpham}/view_add_chitiet', [ChitietsanphamController::class, 'view_add_chitiet'])->name('view_add_chitiet');
    Route::post('admin/add_chitiet', [ChitietsanphamController::class, 'add_chitiet'])->name('add_chitiet');
    Route::get('admin/{id_chitiet}/view_edit_chitiet', [ChitietsanphamController::class, 'view_edit_chitiet'])->name('view_edit_chitiet');
    Route::put('admin/{tensanpham}/edit_chitiet', [ChitietsanphamController::class, 'edit_chitiet'])->name('edit_chitiet');
    Route::delete('admin/{id_chitiet}/delete_chitiet', [ChitietsanphamController::class, 'delete_chitiet'])->name('delete_chitiet');
    Route::get('/admin/chitiet/timkiem', [ChiTietSanPhamController::class, 'timKiem'])->name('admin.timkiem_chitiet');


    //ql chi tiet tung san pham tu trang ql sanpham
    Route::get('admin/{tensanpham}/qlchitietsanpham', [ChitietsanphamController::class, 'qlchitietsanpham'])->name('qlchitietsanpham');

    // Routes cho Quản lý Đơn hàng
    Route::get('/don-hang', [Ql_donhang::class, 'index'])->name('qldonhang');
    Route::get('/don-hang/{id_donhang}', [Ql_donhang::class, 'show'])->name('admin.donhang.show');
    Route::put('/don-hang/{id_donhang}/update-status', [Ql_donhang::class, 'updateStatus'])->name('admin.donhang.update_status');
    Route::delete('/don-hang/{id_donhang}', [Ql_donhang::class, 'destroy'])->name('admin.donhang.destroy');
});

//trực page
Route::middleware(['sale'])->group(function () {
    Route::get('/sale', [AdminController::class, 'index'])->name('sale');
});

//tim kiem san phampham
Route::get('search', [SanphamController::class, 'search'])->name('search');
Route::get('sanpham', [SanphamController::class, 'sanphams'])->name('sanphams');

//mail

Route::get('testmail',[HomeController::class, 'testmail'])->name('testmail');
Route::get('view_quenmk',[HomeController::class, 'view_quenmk'])->name('view_quenmk');

Route::middleware(['auth'])->group(function () {
    // ... các route khác

    // Route cho danh sách đơn hàng
    Route::get('hoadon',[HoadonController::class, 'hienthihoadon'])->name('viewhoadon');

    // Route cho chi tiết đơn hàng (đã có từ trước)
    Route::get('/don-hang-cua-toi/{order}', [HoadonController::class, 'show'])->name('orders.show');
});
// trang hoa don khach hang


// routes/web.php hoặc routes/auth.php (tùy Laravel)
Route::get('/forgot-password', [HomeController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [HomeController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [HomeController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [HomeController::class, 'store'])->name('password.update');

