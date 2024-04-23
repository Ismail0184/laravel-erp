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
        Schema::create('dev_groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name');
            $table->text('address');
            $table->string('website');
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
            $table->integer('cid');
            $table->integer('gid');
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
        Schema::dropIfExists('dev_groups');
    }
};
