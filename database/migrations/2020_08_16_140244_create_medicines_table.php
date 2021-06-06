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
            $table->bigInteger('store_id')->comment("Thuốc này của cừa hàng nào");
            $table->string('name');
            $table->string('package')->nullable()->comment('Quy cách đóng gói');
            $table->integer('inventory')->nullable()->comment('Tồn kho(Số lượng thuốc còn lại trong kho tính theo đơn vị tính nhỏ nhất)');
            $table->integer('rest')->nullable()->comment('Số lượng ít nhất được phép còn lại trong kho tính theo đơn vị tính nhỏ nhất');
            $table->bigInteger('sold')->default(0)->comment('Số lượng đã bán');
            $table->tinyInteger('status')->default(1)->comment('Trạng thái hoạt động của thuốc');
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
