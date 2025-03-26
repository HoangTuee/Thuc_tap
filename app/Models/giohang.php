<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giohang extends Model
{
    use HasFactory;
    protected $table = 'giohang';
    protected $primaryKey = 'id_giohang';
    public $timestamps = false;
    protected $fillable = [
        'id_giohang',
        'id_user',
        'tensanpham',
        'soluong',
        'giasanpham'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sanpham()
    {
        return $this->belongsTo(SanPham::class,'tensanpham','tensanpham');
    }
}
