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
        Schema::create('acc_cost_centers', function (Blueprint $table) {
            $table->id('cc_code')->unique();
            $table->string('center_name')->unique();
            $table->integer('category_id');
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->integer('sconid');
            $table->integer('pcomid');
            $table->integer('entry_by');
            $table->integer('update_by');
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
        Schema::dropIfExists('acc_cost_centers');
    }
};
