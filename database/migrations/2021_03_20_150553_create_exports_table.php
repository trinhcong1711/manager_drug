<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id')->comment("Hóa đơn này của cửa hàng nào!");
            $table->bigInteger("user_id")->comment("Người xuất");
            $table->bigInteger("member_id")->nullable()->comment("Người nhận");
            $table->bigInteger('total_money')->nullable()->default(0)->comment("Tổng tiền của háo đơn");
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0 => Chưa thanh toán | 1 => Đã thanh toán");
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
        Schema::dropIfExists('exports');
    }
}
