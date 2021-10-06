<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('item_id');
            // $table->unsignedInteger('order_id');
            $table->foreignId('product_code')->references('code')->on('products')->onDelete('cascade');
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedInteger('qty')->default(1);
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
        //
    }
}
