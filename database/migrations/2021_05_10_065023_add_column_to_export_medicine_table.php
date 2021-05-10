<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToExportMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('export_medicine', function (Blueprint $table) {
            $table->bigInteger('price')->nullable();
            $table->bigInteger('unit_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('export_medicine', function (Blueprint $table) {
            $table->dropColumn("price");
            $table->dropColumn("unit");
        });
    }
}
