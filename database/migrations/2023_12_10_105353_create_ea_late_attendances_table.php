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
        Schema::create('ea_late_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->date('date');
            $table->string('late_entry_at');
            $table->string('late_reason',255)->nullable();
            $table->enum('status',['DRAFTED','PENDING','RECOMMENDED','NOT RECOMMENDED','APPROVED','NOT APPROVED','REJECTED','GRANTED','DELETED'])->default('DRAFTED');
            $table->integer('recommended_by');
            $table->string('remarks_while_recommended')->nullable();
            $table->timestamp('recommended_at')->nullable(true);
            $table->integer('approved_by');
            $table->string('remarks_while_approved')->nullable();
            $table->timestamp('approved_at')->nullable(true);
            $table->integer('granted_by')->nullable();
            $table->string('remarks_while_granted')->nullable();
            $table->timestamp('granted_at')->nullable(true);
            $table->enum('hrm_viewed',['no','yes'])->default('no');
            $table->timestamp('hrm_viewed_at')->nullable(true);
            $table->enum('employee_viewed',['no','yes'])->default('no');
            $table->timestamp('employee_viewed_at')->nullable(true);
            $table->year('year');
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
        Schema::dropIfExists('ea_late_attendances');
    }
};
