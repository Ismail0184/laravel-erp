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
        Schema::create('hrm_employee_bank_account_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('bank_id');
            $table->string('bank_account_number',33)->nullable();
            $table->string('bank_account_name',33)->nullable();
            $table->string('routing',33)->nullable();
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
        Schema::dropIfExists('hrm_employee_bank_account_infos');
    }
};
