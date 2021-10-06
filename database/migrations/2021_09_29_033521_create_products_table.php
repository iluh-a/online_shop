<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductLine;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
//            $table->id();
            $table->id('code');
            $table->foreignIdFor(\App\Models\ProductLine::class, 'product_line_id')->constrained('product_lines', 'id')
                ->onDelete('cascade');
//                ->onUpdate('cascade')

            $table->string('name');
            $table->integer('scale');
            $table->string('vendor');
            $table->string('pdt_description');
            $table->integer('qty_in_stock');
            $table->decimal('buy_price');
            $table->string('msrp');
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
        Schema::dropIfExists('products');
    }
}
