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
        Schema::create('dev_usage_control_metas', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key')->unique();
            $table->longText('meta_value')->nullable();
            $table->enum('status',['active','postpone'])->default('active');
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
        Schema::dropIfExists('dev_usage_control_metas');
    }
};
