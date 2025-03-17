<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Xác định lại tên bảng
    protected $primaryKey = 'id_user'; // Đặt khóa chính là id_user
    public $incrementing = true; // id_user là auto-increment
    protected $keyType = 'int'; // Kiểu dữ liệu của id_user

    protected $fillable = [
        'username',
        'password',
        'phanquyen',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
