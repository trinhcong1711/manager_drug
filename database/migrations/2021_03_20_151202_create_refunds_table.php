<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bill_id')->nullable()->comment("Hóa đơn nào?");
            $table->bigInteger('user_id')->nullable()->comment("Ai trả?");
            $table->bigInteger('admin_id')->nullable()->comment("Ai là người nhận trả lại?");
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
        Schema::dropIfExists('refunds');
    }
}
