<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_medicine', function (Blueprint $table) {
            $table->bigInteger('medicine_id');
            $table->bigInteger('import_id');
            $table->integer('price')->nullable()->comment("Giá nhập");
            $table->integer('amount')->default(0)->comment("Số lượng");
            $table->string('unit_name')->nullable()->comment("Đơn vị tính");
            $table->text('note')->nullable()->comment("Ghi chú");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_medicine');
    }
}
