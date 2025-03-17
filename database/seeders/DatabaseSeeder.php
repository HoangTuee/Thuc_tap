<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = new User;
        $user1->username = 'admin';
        $user1->password = 'admin'; // Mã hóa mật khẩu
        $user1->phanquyen = 'admin';
        $user1->save();
    }
}
