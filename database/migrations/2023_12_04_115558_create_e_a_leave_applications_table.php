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
        Schema::create('e_a_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('total_days');
            $table->string('reason',255)->nullable();
            $table->integer('responsible_person')->nullable();
            $table->string('leave_address',150)->nullable();
            $table->string('leave_mobile_number')->nullable();
            $table->string('att_file')->nullable();
            $table->enum('status',['DRAFTED','PENDING','RECOMMENDED','NOT RECOMMENDED','APPROVED','NOT APPROVED','REJECTED','GRANTED'])->default('DRAFTED');
            $table->integer('recommended_by');
            $table->string('remarks_while_recommended')->nullable();
            $table->timestamp('recommended_at')->nullable(true)->useCurrent();
            $table->integer('approved_by');
            $table->string('remarks_while_approved')->nullable();
            $table->timestamp('approved_at')->nullable(true)->useCurrent();
            $table->integer('granted_by')->nullable();
            $table->string('remarks_while_granted')->nullable();
            $table->timestamp('granted_at')->nullable(true)->useCurrent();
            $table->enum('hrm_viewed',['no','yes'])->default('no');
            $table->timestamp('hrm_viewed_at')->nullable(true)->useCurrent();
            $table->enum('employee_viewed',['no','yes'])->default('no');
            $table->timestamp('employee_viewed_at')->nullable(true)->useCurrent();
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
        Schema::dropIfExists('e_a_leave_applications');
    }
};
