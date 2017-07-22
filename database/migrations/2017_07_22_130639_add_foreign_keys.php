<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id', 'orders-users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id', 'order_items-orders')->references('id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('product_id', 'order_items-products')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items-products');
            $table->dropForeign('order_items-orders');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders-users');
        });
    }
}
