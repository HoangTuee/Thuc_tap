<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_donhang');
            $table->unsignedBigInteger('id_sanpham');
            $table->integer('soluong');
            $table->decimal('gia', 15, 2);
            $table->decimal('thanhtien', 15, 2);
            $table->timestamps();
            $table->foreign('id_donhang')->references('id_donhang')->on('donhang')->onDelete('cascade');
            $table->foreign('id_sanpham')->references('id_sanpham')->on('sanpham')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdonhangs');
    }
};
