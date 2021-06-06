<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("code")->comment("Mã đơn hàng: HĐ001");
            $table->bigInteger('store_id')->comment("Đơn hàng này của cửa hàng nào?");
            $table->bigInteger('member_id')->nullable()->comment("Người mua");
            $table->bigInteger('user_id')->comment("Người bán?");
            $table->bigInteger('total')->nullable()->comment("Tổng tiền");
            $table->text('note')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
