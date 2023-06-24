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
        Schema::create('pro_vendor_infos', function (Blueprint $table) {
            $table->id('vendor_id');
            $table->bigInteger('ledger_id');
            $table->string('vendor_name')->unique();
            $table->text('address');
            $table->string('contact_no');
            $table->string('email');
            $table->string('TIN');
            $table->string('BIN');
            $table->string('poc_name');
            $table->string('poc_designation');
            $table->string('poc_mobile');
            $table->string('poc_email');
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->integer('category');
            $table->integer('entry_by');
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
        Schema::dropIfExists('pro_vendor_infos');
    }
};
