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
        'ma_don_hang',
        'id_user',
        'tennguoinhan',
        'sdt_nguoinhan',
        'diachi_giaohang',
        'ghichu',
        'phuongthuc_thanhtoan',
        'trangthai',
        'tong_thanhtien',
    ];

        public function chiTietDonHangs()
    {
        // Model DonHang có nhiều ChiTietDonHang
        return $this->hasMany(ChiTietDonHang::class, 'id_donhang', 'id_donhang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
