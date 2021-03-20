<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_medicine', function (Blueprint $table) {
            $table->bigInteger('bill_id');
            $table->bigInteger('medicine_id');
            $table->integer('amount')->nullable()->comment("Số lượng");
            $table->bigInteger('unit_id')->nullable()->comment("Đơn vị tính");
            $table->integer('price')->nullable()->comment("Giá bán");
            $table->bigInteger('exp')->nullable()->comment("Hạn xử dụng");
            $table->integer('total_price')->default(0)->comment("Thành tiền");
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('bill_medicine');
    }
}
