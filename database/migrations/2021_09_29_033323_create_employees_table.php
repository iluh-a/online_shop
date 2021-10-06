<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Office::class, 'office_code')->constrained('offices', 'code')
                ->onDelete('cascade');
//                ->onUpdate('cascade')
            $table->foreignIdFor(\App\Models\Employee::class, 'reports_to')->constrained('employees', 'id')
                ->onDelete('cascade');
//                ->onUpdate('cascade')
            $table->text('lastname');
            $table->text('firstname');
            $table->text('extension');
            $table->text('email');
            $table->text('job_title');
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
        Schema::dropIfExists('employees');
    }
}
