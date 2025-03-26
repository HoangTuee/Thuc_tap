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
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('id_sanpham');
            $table->string('tensanpham', 100)->unique();//unique ten duy nhat
            $table->integer('giasanpham');
            $table->string('anhsanpham', 100);
            $table->integer('giakhuyenmai');
            $table->string('thongso_sanpham', 100);
            $table->string('danhmuc', 100);
            $table->string('hangsanpham',100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
};
