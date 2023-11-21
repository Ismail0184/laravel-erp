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
        Schema::create('hrm_employee_job_infos', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('appointment_ref_no',33)->nullable();
            $table->date('appointment_date')->nullable();
            $table->date('confirmation_date')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('corporate_mobile',33)->nullable();
            $table->string('corporate_email',33)->nullable();
            $table->integer('employment_type')->nullable();
            $table->integer('job_location')->nullable();
            $table->integer('department')->nullable();
            $table->integer('designation')->nullable();
            $table->integer('grade')->nullable();
            $table->integer('shift')->nullable();
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
        Schema::dropIfExists('hrm_employee_job_infos');
    }
};
