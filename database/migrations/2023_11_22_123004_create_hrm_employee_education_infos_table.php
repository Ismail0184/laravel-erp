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
        Schema::create('hrm_employee_education_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('education_degree')->nullable();
            $table->string('grade')->nullable();
            $table->integer('passing_year')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('scale')->nullable();
            $table->integer('institute')->nullable();
            $table->enum('last_education',['no','yes']);
            $table->enum('institute_type',['Local','Foreign','Professional']);
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
        Schema::dropIfExists('hrm_employee_education_infos');
    }
};
