<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('site_id')->index()->default(0);
            $table->unsignedInteger('good_id')->index()->default(0);
            $table->unsignedInteger('unique_key')->index()->default(0);
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
        Schema::dropIfExists('site_goods');
    }
}
