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
        Schema::create('acc_sub_ledgers', function (Blueprint $table) {
            $table->id('sub_ledger_id')->unique();
            $table->string('sub_ledger_name')->unique();
            $table->bigInteger('ledger_id');
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->integer('sconid');
            $table->integer('pcomid');
            $table->integer('entry_by');
            $table->integer('update_by');
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
        Schema::dropIfExists('acc_sub_ledgers');
    }
};
