<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Employee::class, 'sales_rep_employee_num')
                ->constrained('employees', 'id')
                ->onDelete('cascade');
//                ->onUpdate('cascade')
            $table->text('name');
            $table->text('lastname');
            $table->text('firstname');
            $table->text('phone');
            $table->text('address1');
            $table->text('address2');
            $table->text('city');
            $table->text('state');
            $table->integer('postal_code');
            $table->text('country');
            $table->decimal('credit_limit');
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
        Schema::dropIfExists('customers');
    }
}
