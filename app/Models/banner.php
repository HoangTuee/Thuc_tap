<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table = 'banner'; // Chỉ định rõ tên bảng
    protected $primaryKey = 'id_banner';
    public $timestamps = false;
    protected $fillable = ['anh_banner','tensanpham'];
}
