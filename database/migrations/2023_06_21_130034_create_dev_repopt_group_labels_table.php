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
        Schema::create('dev_repopt_group_labels', function (Blueprint $table) {
            $table->id();
            $table->integer('serial');
            $table->integer('optgroup_label_id')->unique();
            $table->string('optgroup_label_name');
            $table->integer('module_id');
            $table->enum('status',['active','inactive']);
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
        Schema::dropIfExists('dev_repopt_group_labels');
    }
};
