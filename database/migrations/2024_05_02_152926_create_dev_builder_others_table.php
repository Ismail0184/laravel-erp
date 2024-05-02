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
        Schema::create('dev_builder_others', function (Blueprint $table) {
            $table->id();
            $table->string('name','100');
            $table->string('key','100')->nullable();
            $table->string('route')->nullable();
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
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
        Schema::dropIfExists('dev_builder_others');
    }
};
