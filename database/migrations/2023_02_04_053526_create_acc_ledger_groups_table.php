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
        Schema::create('acc_ledger_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->string('group_name');
            $table->integer('sub_class_id');
            $table->integer('class_id');
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
        Schema::dropIfExists('acc_ledger_groups');
    }
};
