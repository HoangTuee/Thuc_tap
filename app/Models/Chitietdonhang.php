<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    use HasFactory;
    protected $table = 'chitietdonhang';
    protected $fillable = [
        'id_donhang',
        'id_sanpham',
        'soluong',
        'gia',
        'thanhtien',
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'id_donhang', 'id_donhang');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_sanpham', 'id_sanpham');
    }
}
