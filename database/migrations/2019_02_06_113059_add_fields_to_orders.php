<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //order status
            $table->string('order_status')->default('unprocessed');
            $table->string('payment_method')->index()->default(0);
            $table->string('department_number')->nullable();
            $table->string('delivery_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_status');
            $table->dropColumn('payment_method');
            $table->dropColumn('department_number');
            $table->dropColumn('delivery_status');
        });
    }
}
