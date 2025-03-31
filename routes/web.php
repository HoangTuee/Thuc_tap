<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChitietsanphamController;
use App\Http\Controllers\GiohangController;
use App\Http\Controllers\SanphamController;
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

Route::get('/signup',[LoginController::class, 'signup'])->name('signup');
Route::post('/add_signup',[LoginController::class, 'add_signup'])->name('addsignup');

//User
Route::get('/tintuc', [UserController::class, 'tintuc'])->name('tintuc');
Route::get('/laptopnew', [UserController::class, 'laptopnew'])->name('laptopnew');
Route::get('/khuyenmai',[UserController::class, 'khuyenmai'])->name('khuyenmai');

//Chi tiet san pham
Route::get('/chitietsanpham/{tensanpham}',[ChitietsanphamController::class, 'chitiet'])->name('chitiet');

//gio hang
Route::get('/giohang',[GiohangController::class, 'giohang'])->name('giohang');
Route::post('/add_giohang',[GiohangController::class, 'add_giohang'])->name('addgiohang');
Route::delete('/delete_giohang/{id}',[GiohangController::class, 'delete_giohang'])->name('deletegiohang');

//Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    //ql san pham
    Route::get('admin/sanpham', [SanphamController::class, 'sanpham'])->name('sanpham');
    Route::get('admin/view_add_sanpham',[SanphamController::class, 'view_add_sanpham'])->name('view_add_sanpham');
    Route::post('admin/add_sanpham',[SanphamController::class, 'add_sanpham'])->name('add_sanpham');
    Route::get('admin/{id}/view_edit_sanpham',[SanphamController::class, 'view_edit_sanpham'])->name('view_edit_sanpham');
    Route::put('admin/{id}/edit_sanpham',[SanphamController::class, 'edit_sanpham'])->name('edit_sanpham');
    Route::delete('admin/{id}/delete_sanpham',[SanphamController::class, 'delete_sanpham'])->name('delete_sanpham');

    //ql tai khoan
    Route::get('admin/qladmin', [AdminController::class, 'qladmin'])->name('qladmin');
    Route::get('admin/adduser', [AdminController::class, 'view_add_user'])->name('view_add_user');
    Route::post('admin/users', [AdminController::class, 'add_user'])->name('users.store');
    Route::get('admin/{id}/edituser', [AdminController::class, 'view_edit_user'])->name('view_edit_user');
    Route::put('admin/{id}/edituser', [AdminController::class, 'edit_user'])->name('edit_user');
    Route::delete('admin/{id}/delete_user', [AdminController::class, 'delete_user'])->name('delete_user');

    //ql banner
    Route::get('admin/qlbanner', [BannerController::class, 'qlbanner'])->name('qlbanner');
    Route::get('admin/view_add_banner', [BannerController::class, 'view_add_banner'])->name('view_add_banner');
    Route::post('admin/add_banner', [BannerController::class, 'add_banner'])->name('add_banner');
    Route::get('admin/{id}/view_edit_banner',[BannerController::class, 'view_edit_banner'])->name('view_edit_banner');
    Route::put('admin/{banner}/edit_banner',[BannerController::class, 'edit_banner'])->name('edit_banner');
    Route::delete('admin/{id}',[BannerController::class, 'delete_banner'])->name('delete_banner');

    //ql chi tiet
    Route::get('admin/qlchitiet',[ChitietsanphamController::class, 'qlchitiet'])->name('qlchitiet');
    Route::get('admin/{tensanpham}/view_add_chitiet',[ChitietsanphamController::class, 'view_add_chitiet'])->name('view_add_chitiet');
    Route::post('admin/add_chitiet',[ChitietsanphamController::class,'add_chitiet'])->name('add_chitiet');
    Route::get('admin/{id_chitiet}/view_edit_chitiet',[ChitietsanphamController::class, 'view_edit_chitiet'])->name('view_edit_chitiet');
    Route::put('admin/{tensanpham}/edit_chitiet',[ChitietsanphamController::class, 'edit_chitiet'])->name('edit_chitiet');
    Route::delete('admin/{id_chitiet}/delete_chitiet',[ChitietsanphamController::class, 'delete_chitiet'])->name('delete_chitiet');

    //ql chi tiet tung san pham
    Route::get('admin/{tensanpham}/qlchitietsanpham',[ChitietsanphamController::class, 'qlchitietsanpham'])->name('qlchitietsanpham');
    // Route::get('admin/view_add_chitiet',[ChitietsanphamController::class, 'view_add_chitietsanpham'])->name('view_add_chitietsanpham');
    // Route::post('admin/add_chitiet',[ChitietsanphamController::class,'add_chitietsanpham'])->name('add_chitietsanpham');
    // Route::get('admin/{tensanpham}/view_edit_chitiet',[ChitietsanphamController::class, 'view_edit_chitietsanpham'])->name('view_edit_chitietsanpham');
    // Route::put('admin/{tensanpham}/edit_chitiet',[ChitietsanphamController::class, 'edit_chitietsanpham'])->name('edit_chitietsanpham');
    // Route::delete('admin/{tensanpham}/delete_chitiet',[ChitietsanphamController::class, 'delete_chitietsanpham'])->name('delete_chitetsanpham');


});
Route::get('search',[SanphamController::class, 'search'])->name('search');
