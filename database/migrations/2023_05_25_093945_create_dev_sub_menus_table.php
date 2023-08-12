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
        Schema::create('dev_sub_menus', function (Blueprint $table) {
            $table->id('sub_menu_id');
            $table->integer('serial')->nullable();
            $table->string('sub_menu_name','100');
            $table->string('sub_url','100')->nullable();
            $table->string('faicon','33')->nullable();
            $table->integer('main_menu_id');
            $table->string('module_id','33');
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
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
        Schema::dropIfExists('dev_sub_menus');
    }
};
