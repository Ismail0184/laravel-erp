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
        Schema::create('dev_main_menus', function (Blueprint $table) {
            $table->id('main_menu_id');
            $table->integer('serial');
            $table->string('main_menu_name','55');
            $table->string('url','100');
            $table->string('quick_access_url','100');
            $table->string('faicon');
            $table->integer('module_id');
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
        Schema::dropIfExists('dev_main_menus');
    }
};
