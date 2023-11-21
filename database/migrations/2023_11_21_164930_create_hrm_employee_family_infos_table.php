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
        Schema::create('hrm_employee_family_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('name',55)->nullable();
            $table->integer('relationship')->nullable();
            $table->string('nid')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
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
        Schema::dropIfExists('hrm_employee_family_infos');
    }
};
