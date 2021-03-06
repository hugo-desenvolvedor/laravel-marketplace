<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreUserOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Store, UserOrder  -> store_user_order
        Schema::create('store_user_order', function (Blueprint $table) {
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('user_order_id');

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('user_order_id')->references('id')->on('user_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_user_order');
    }
}
