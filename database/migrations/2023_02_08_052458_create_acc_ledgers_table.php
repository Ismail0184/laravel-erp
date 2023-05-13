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
        Schema::create('acc_ledgers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ledger_id')->unique();
            $table->string('ledger_name')->unique();
            $table->bigInteger('group_id');
            $table->enum('type',['ledger','sub','sub-sub']);
            $table->integer('status')->default('1');
            $table->integer('sconid');
            $table->integer('pcomid');
            $table->integer('entry_by');
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
        Schema::dropIfExists('acc_ledgers');
    }
};
