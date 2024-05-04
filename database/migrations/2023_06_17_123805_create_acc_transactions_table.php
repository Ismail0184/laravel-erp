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
        Schema::create('acc_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_no');
            $table->date('transaction_date');
            $table->bigInteger('ledger_id');
            $table->bigInteger('relevant_cash_head');
            $table->text('narration')->nullable();
            $table->double('dr_amt');
            $table->double('cr_amt');
            $table->integer('cc_code')->nullable();
            $table->enum('type',['Debit','Credit']);
            $table->string('vr_from');
            $table->bigInteger('vr_no');
            $table->integer('vr_id');
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','APPROVED','AUDITED','DELETED']);
            $table->integer('entry_by');
            $table->integer('visible_status')->default('1');
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
        Schema::dropIfExists('acc_transactions');
    }
};
