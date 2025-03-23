<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietsanpham extends Model
{
    use HasFactory;
    protected $table = 'chitietsanpham';
    protected $primaryKey = 'id_chitiet';
    public $timestamps = false;

    protected $fillable = [
        'tensanpham',
        'cauhinh_sanpham',
        'tinhtrang_sanpham',
        'anhchitiet1',
        'anhchitiet2',
        'anhchitiet3',
        'anhchitiet4'
    ];
}
