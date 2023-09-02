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
        Schema::create('hrm_leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type_name','100');
            $table->integer('yearly_leave_days');
            $table->enum('status',['active','inactive','suspended','deleted'])->default('active');
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
        Schema::dropIfExists('hrm_leave_types');
    }
};
