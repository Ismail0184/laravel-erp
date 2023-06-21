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
        Schema::create('dev_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('serial');
            $table->integer('report_id')->unique();
            $table->string('report_name');
            $table->integer('optgroup_label_id');
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
        Schema::dropIfExists('dev_reports');
    }
};
