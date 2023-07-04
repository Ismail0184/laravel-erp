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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id('warehouse_id');
            $table->string('warehouse_name');
            $table->string('nick_name');
            $table->text('address');
            $table->text('VMS_address');
            $table->string('poc_name');
            $table->string('poc_designation');
            $table->string('poc_number');
            $table->string('poc_email');
            $table->enum('use_type',['WH','PL','SD','DM','TR']);
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->bigInteger('ledger_id');
            $table->bigInteger('ledger_id_RM');
            $table->bigInteger('ledger_id_FG');
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
        Schema::dropIfExists('warehouses');
    }
};
