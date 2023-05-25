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
        Schema::create('dev_modules', function (Blueprint $table) {
            $table->id('module_id')->unique();
            $table->integer('serial');
            $table->string('modulename',55);
            $table->string('module_short_name',33);
            $table->string('fa_icon',33);
            $table->string('fa_icon_color',33);
            $table->string('notification_type',33);
            $table->string('section_type',33);
            $table->enum('status',['1','0'])->default('1');
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
        Schema::dropIfExists('dev_modules');
    }
};
