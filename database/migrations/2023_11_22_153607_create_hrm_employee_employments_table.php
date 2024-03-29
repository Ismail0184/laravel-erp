<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_employee_employments', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->string('job_title')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('last_salary')->nullable();
            $table->enum('exp_letter',['yes','no']);
            $table->enum('noc',['yes','no']);
            $table->string('remarks')->nullable();
            $table->integer('entry_by');
            $table->integer('updated_by')->nullable();
            $table->integer('sconid');
            $table->integer('pcomid');
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
        Schema::dropIfExists('hrm_employee_employments');
    }
};
