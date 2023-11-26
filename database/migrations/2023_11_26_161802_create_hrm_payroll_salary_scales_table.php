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
        Schema::create('hrm_payroll_salary_scales', function (Blueprint $table) {
            $table->id();
            $table->double('basic_amount')->nullable();
            $table->double('house_rent')->nullable();
            $table->double('conveyance_bill')->nullable();
            $table->double('phone_bill')->nullable();
            $table->double('medical_allowance')->nullable();
            $table->double('income_tax')->nullable();
            $table->double('pf_amount')->nullable();
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
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
        Schema::dropIfExists('hrm_payroll_salary_scales');
    }
};
