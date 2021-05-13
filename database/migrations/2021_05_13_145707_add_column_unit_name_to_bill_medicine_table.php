<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUnitNameToBillMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_medicine', function (Blueprint $table) {
            $table->string("unit_name")->nullable()->comment("Đơn vị tính");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_medicine', function (Blueprint $table) {
            $table->dropColumn("unit_name");
        });
    }
}
