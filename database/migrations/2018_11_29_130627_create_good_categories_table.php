<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->index()->default(0);
            $table->string('slug', 191)->unique();
            $table->string('name', 191)->index();
            $table->text('img')->nullable();            
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
        Schema::dropIfExists('good_categories');
    }
}
