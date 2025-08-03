<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id('id_donhang');
            $table->string('ma_don_hang', 20)->unique();
            $table->unsignedBigInteger('id_user');
            $table->string('tennguoinhan', 100);
            $table->string('sdt_nguoinhan', 15);
            $table->string('diachi_giaohang', 255);
            $table->text('ghichu')->nullable();
            $table->string('phuongthuc_thanhtoan', 50);
            $table->string('trangthai', 50)->default('Đang xử lý');
            $table->decimal('tong_thanhtien', 15, 2);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('donhang');
    }
};
