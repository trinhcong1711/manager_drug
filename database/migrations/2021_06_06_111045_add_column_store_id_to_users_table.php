<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStoreIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Nhân viên này thuộc cửa hàng nào");
            $table->tinyInteger("is_owner")->comment("1=> Người có chức vụ cao nhất cửa hàng | 0=> Chức vụ khác");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("store_id");
            $table->dropColumn("is_owner");
        });
    }
}
