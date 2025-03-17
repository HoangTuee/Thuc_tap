<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ql_khuyenmai extends Model
{
    use HasFactory;
    protected $table = 'ql_khuyenmai';
    protected $primaryKey = 'id_khuyenmai';

    protected $fillable = ['makhuyenmai', 'giamgia'];
}
