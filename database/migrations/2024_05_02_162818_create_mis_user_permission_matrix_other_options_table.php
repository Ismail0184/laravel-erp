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
        Schema::create('mis_user_permission_matrix_other_options', function (Blueprint $table) {
            $table->id();
            $table->integer('other_option_id');
            $table->integer('user_id');
            $table->integer('permitted_by');
            $table->enum('status',['active','inactive','suspended'])->default('active');
            $table->integer('company_id');
            $table->integer('group_id');
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
        Schema::dropIfExists('mis_user_permission_matrix_other_options');
    }
};
