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
        Schema::create('hrm_employees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('full_name',100)->nullable();
            $table->string('father_name',100)->nullable();
            $table->string('mother_name',100)->nullable();
            $table->string('spouse_name',100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('blood_group')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('religion')->nullable();
            $table->integer('marital_status')->nullable();
            $table->integer('nationality')->nullable();
            $table->string('national_id',13)->nullable();
            $table->string('birth_certificate_id',17)->nullable();
            $table->string('passport_id',15)->nullable();
            $table->string('driving_license',22)->nullable();
            $table->enum('job_status',['In Service','Not In Service'])->default('In Service');
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
            $table->string('image',500)->nullable();
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
        Schema::dropIfExists('hrm_employees');
    }
};
