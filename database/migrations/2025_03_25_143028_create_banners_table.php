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
        Schema::create('banner', function (Blueprint $table) {
            $table->id('id_banner');
            $table->string('anh_banner', 100);
            $table->string('tensanpham',100)->unique();
            $table->foreign('tensanpham')->references('tensanpham')->on('sanpham')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner');
    }
};
