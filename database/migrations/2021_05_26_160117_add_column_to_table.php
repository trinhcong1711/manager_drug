<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment("Tên chủ cửa hàng");
            $table->string('store')->nullable()->comment("Tên cửa hàng");
            $table->string('email')->nullable();
            $table->integer('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('medicines', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Thuốc này của cửa hàng nào!");
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Đơn này của cửa hàng nào!");
        });
        Schema::table('exports', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Đơn xuất này của cửa hàng nào!");
        });
        Schema::table('imports', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Đơn nhập này của cửa hàng nào!");
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Quyền này của cửa hàng nào!");
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Nhóm quyền này của cửa hàng nào!");
        });
        Schema::table('units', function (Blueprint $table) {
            $table->bigInteger("store_id")->comment("Đơn vị tính này của cửa hàng nào!");
        });
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger("store_id")->nullable()->comment("Nhân viên này của cửa hàng nào!");
        });
        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger("store_id")->nullable()->comment("Khách này của cửa hàng nào!");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("stores");
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('exports', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('imports', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn("store_id");
        });
    }
}
