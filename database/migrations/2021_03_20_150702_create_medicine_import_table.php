<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_import', function (Blueprint $table) {
            $table->bigInteger('medicine_id');
            $table->bigInteger('import_id');
            $table->integer('price')->nullable()->comment("Giá nhập");
            $table->integer('amount')->default(0)->comment("Số lượng");
            $table->string('unit')->comment("Đơn vị nhập");
//            $table->bigInteger('exp_id')->nullable()->comment("Hạn xử dụng");
            $table->tinyInteger('status')->default(0)->comment("0 => Chưa kiểm | 1 => Đã kiểm");
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
        Schema::dropIfExists('medicine_import');
    }
}
