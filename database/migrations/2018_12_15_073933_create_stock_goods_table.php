<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stock_id')->index()->default(0);
            $table->unsignedInteger('good_id')->index()->default(0);
            $table->unsignedInteger('quantity')->index()->default(0);
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
        Schema::dropIfExists('stock_goods');
    }
}
