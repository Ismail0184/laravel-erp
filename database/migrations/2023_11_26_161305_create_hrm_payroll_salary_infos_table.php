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
        Schema::create('hrm_payroll_salary_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->double('gross_salary')->nullable();
            $table->double('basic_salary')->nullable();
            $table->double('house_rent')->nullable();
            $table->double('special_allowance')->nullable();
            $table->double('conveyance_bill')->nullable();
            $table->double('DA')->nullable();
            $table->double('others')->nullable();
            $table->enum('transportAllwAppl',['No','Yes'])->default('No');
            $table->double('transport_allowance')->nullable();
            $table->enum('food_alw_applicable',['No','Yes'])->default('No');
            $table->double('food_allowance')->nullable();
            $table->enum('mobile_alw_applicable',['No','Yes'])->default('No');
            $table->double('mobile_allowance')->nullable();
            $table->double('mobile_ceiling')->nullable();
            $table->double('medical_allowance')->nullable();
            $table->enum('bonus_applicable',['No','Yes'])->default('No');
            $table->double('bonus')->nullable();
            $table->enum('overtime_applicable',['No','Yes'])->default('No');
            $table->double('overtime_rate')->nullable();
            $table->enum('pf_applicable',['No','Yes'])->default('No');
            $table->double('pf_percentage')->nullable();
            $table->double('pf')->nullable();
            $table->enum('carFacilitiesAppl',['No','Yes'])->default('No');
            $table->double('carFacilitiesAmt')->nullable();
            $table->double('income_tax')->nullable();
            $table->double('total_payable_amount')->nullable();
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
        Schema::dropIfExists('hrm_payroll_salary_infos');
    }
};
