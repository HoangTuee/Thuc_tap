<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';
    protected $primaryKey = 'id_sanpham';
    public $timestamps = false;

    protected $fillable = [
        'tensanpham',
        'giasanpham',
        'anhsanpham',
        'giabandau',
        'giakhuyenmai',
        'thongso_sanpham',
        'danhmuc',
        'hangsanpham'
    ];
}
