<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    use HasFactory;
    protected $table = 'donhang';
    protected $primaryKey = 'id_donhang';
    protected $fillable = [
        'ma_don_hang_chung',
        'id_user',
        'tennguoinhan',
        'sdt_nguoinhan',
        'diachi_giaohang',
        'ghichu',
        'phuongthuc_thanhtoan',
        'trangthai',
        'id_sanpham',
        'tensanpham',
        'soluong',
        'gia',
        'thanhtien',
    ];
}
