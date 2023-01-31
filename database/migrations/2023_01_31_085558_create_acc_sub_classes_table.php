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
            $table->id();
            $table->integer('class_id')->unique();
            $table->string('subclass_name', 33)->unique();
            $table->integer('status')->default('1');
            $table->integer('scomid')->default('1');
            $table->integer('pcomid')->default('1');
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
