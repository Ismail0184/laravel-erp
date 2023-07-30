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
        Schema::create('sal_areas', function (Blueprint $table) {
            $table->id('area_id');
            $table->integer('serial')->nullable();
            $table->string('area_name')->unique();
            $table->integer('region_id');
            $table->integer('in_charge_person');
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->integer('entry_by');
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
        Schema::dropIfExists('sal_areas');
    }
};
