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
        Schema::create('hrm_employee_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('mobile',22)->nullable();
            $table->string('alternative_mobile',22)->nullable();
            $table->string('email',33)->nullable();
            $table->string('present_address',255)->nullable();
            $table->integer('present_address_country')->nullable();
            $table->integer('present_address_state')->nullable();
            $table->integer('present_address_city')->nullable();
            $table->integer('present_address_police_station')->nullable();
            $table->integer('present_address_post_office')->nullable();
            $table->integer('present_address_zip_code')->nullable();
            $table->string('permanent_address',255)->nullable();
            $table->integer('permanent_address_country')->nullable();
            $table->integer('permanent_address_state')->nullable();
            $table->integer('permanent_address_city')->nullable();
            $table->integer('permanent_address_police_station')->nullable();
            $table->integer('permanent_address_post_office')->nullable();
            $table->integer('permanent_address_zip_code')->nullable();
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
        Schema::dropIfExists('hrm_employee_contact_infos');
    }
};
