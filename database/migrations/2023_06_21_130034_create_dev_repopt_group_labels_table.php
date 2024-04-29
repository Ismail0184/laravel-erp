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
            $table->enum('status',['active','inactive','deleted']);
            $table->integer('module_id');
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
        Schema::dropIfExists('dev_repopt_group_labels');
    }
};
