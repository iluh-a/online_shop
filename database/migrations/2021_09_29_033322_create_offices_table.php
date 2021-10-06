<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
//            $table->id();
            $table->id('code');
            $table->text('city');
            $table->text('phone');
            $table->text('address1');
            $table->text('address2');
            $table->text('state');
            $table->text('country');
            $table->integer('postal_code');
            $table->text('territory');
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
        Schema::dropIfExists('offices');
    }
}
