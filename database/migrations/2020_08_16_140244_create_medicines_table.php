<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('amount')->nullable()->comment('Hàm lượng');
            $table->date('exp')->nullable()->comment('Hạn sử dụng');
            $table->string('package')->nullable()->comment('Quy cách đóng gói');
            $table->integer('inventory')->nullable()->comment('Tồn kho');
            $table->integer('price_import')->default(0)->comment('Giá nhập');
            $table->text('price')->nullable()->comment('Giá bán');
            $table->bigInteger('sold')->default(0)->comment('Số lượng đã bán');
            $table->tinyInteger('status')->default(0)->comment('Trạng thái hoạt động của thuốc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
