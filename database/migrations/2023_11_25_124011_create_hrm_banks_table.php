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
        Schema::create('hrm_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name','100');
            $table->string('branch')->nullable();
            $table->string('address',255)->nullable();
            $table->string('phone',11)->nullable();
            $table->string('mobile',22)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('email',50)->nullable();
            $table->string('web',100)->nullable();
            $table->string('contract',50)->nullable();
            $table->string('cp_phone',11)->nullable();
            $table->string('cp_mobile',11)->nullable();
            $table->string('routing',20)->nullable();
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
        Schema::dropIfExists('hrm_banks');
    }
};
