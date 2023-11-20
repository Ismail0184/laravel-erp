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
        Schema::create('hrm_nationalities', function (Blueprint $table) {
            $table->id();
            $table->integer('num_code')->nullable();
            $table->string('alpha_2_code',2)->nullable();
            $table->string('alpha_3_code',3)->nullable();
            $table->string('en_short_name',52)->nullable();
            $table->string('nationality',40)->nullable();
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
        Schema::dropIfExists('hrm_nationalities');
    }
};
