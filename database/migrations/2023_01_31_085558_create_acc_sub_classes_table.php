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
        Schema::create('acc_sub_classes', function (Blueprint $table) {
            $table->id('sub_class_id');
            $table->integer('class_id');
            $table->string('sub_class_name', 33)->unique();
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('acc_sub_classes');
    }
};
