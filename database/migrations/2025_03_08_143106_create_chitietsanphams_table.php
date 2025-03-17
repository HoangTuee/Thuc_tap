<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chitietsanpham', function (Blueprint $table) {
            $table->id('id_chitiet');
            $table->string('tensanpham', 100)->unique(); // UNIQUE vì được dùng làm khóa ngoại
            $table->string('cauhinh_sanpham', 100);
            $table->string('tinhtrang_sanpham', 100);
            $table->string('anhchitiet1', 100);
            $table->string('anhchitiet2', 100);
            $table->string('anhchitiet3', 100);
            $table->string('anhchitiet4', 100);
            $table->foreign('tensanpham')->references('tensanpham')->on('sanpham')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chitietsanpham');
    }
};
