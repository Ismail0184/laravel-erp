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
        Schema::create('sal_dealer_types', function (Blueprint $table) {
            $table->id('type_id');
            $table->string('type_name');
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->integer('entry_by');
            $table->integer('sconid');
            $table->integer('pcomid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_dealer_types');
    }
};
