<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('giohang', function (Blueprint $table) {
            // Xóa FOREIGN KEY trước
            $table->dropForeign(['tensanpham']); // tên cột

            // Sau đó mới xóa UNIQUE INDEX
            $table->dropUnique('giohang_tensanpham_unique');

            // Thêm UNIQUE mới theo tổ hợp
            $table->unique(['id_user', 'tensanpham'], 'unique_user_product');

            // Thêm lại FOREIGN KEY sau cùng
            $table->foreign('tensanpham')->references('tensanpham')->on('sanpham')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('giohang', function (Blueprint $table) {
            $table->dropForeign(['tensanpham']);
            $table->dropUnique('unique_user_product');
            $table->unique('tensanpham', 'giohang_tensanpham_unique');
            $table->foreign('tensanpham')->references('tensanpham')->on('sanpham')->onDelete('cascade');
        });
    }
};

