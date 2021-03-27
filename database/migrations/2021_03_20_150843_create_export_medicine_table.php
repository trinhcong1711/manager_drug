<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_medicine', function (Blueprint $table) {
            $table->bigInteger('medicine_id');
            $table->bigInteger('export_id');
            $table->integer('amount')->default(0)->comment("Số lượng");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_medicine');
    }
}
