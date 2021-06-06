<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id')->comment("Hóa đơn này của cửa hàng nào!");
            $table->text('user_id')->comment("Người tạo hóa đơn nhập!");
            $table->text('note')->nullable();
            $table->dateTime('checked_at')->nullable()->comment("Ngày kiểm phiếu");
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
        Schema::dropIfExists('imports');
    }
}
