<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodParsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_parses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('link')->nullable();
            $table->tinyInteger('parsed')->index()->default(0);
            $table->text('slug')->nullable();
            $table->text('name')->nullable();
            $table->text('categories')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('good_parses');
    }
}
