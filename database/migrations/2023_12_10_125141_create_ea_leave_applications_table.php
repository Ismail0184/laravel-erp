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
        Schema::create('ea_leave_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('total_days');
            $table->double('balance_days');
            $table->string('reason',255)->nullable();
            $table->integer('responsible_person')->nullable();
            $table->string('leave_address',150)->nullable();
            $table->string('leave_mobile_number')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('ea_leave_applications');
    }
};
