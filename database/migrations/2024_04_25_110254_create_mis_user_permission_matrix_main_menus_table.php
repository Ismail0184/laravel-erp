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
        Schema::create('mis_user_permission_matrix_main_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('main_menu_id');
            $table->integer('user_id');
            $table->integer('permitted_by');
            $table->integer('module_id');
            $table->integer('company_id');
            $table->integer('group_id');
            $table->enum('status',['active','inactive','suspended'])->default('active');
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
        Schema::dropIfExists('mis_user_permission_matrix_main_menus');
    }
};
