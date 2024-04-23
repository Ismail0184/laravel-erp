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
        Schema::create('dev_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->string('company_name');
            $table->text('address');
            $table->string('website');
            $table->string('telephone');
            $table->string('trade_license');
            $table->string('VAT_registration');
            $table->string('logo');
            $table->string('logo_color');
            $table->string('TIN');
            $table->string('BIN');
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
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
        Schema::dropIfExists('dev_companies');
    }
};
