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
        Schema::create('acc_voucher_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('voucher_no');
            $table->date('voucher_date');
            $table->string('person','55')->nullable();
            $table->string('cheque_no','55')->nullable();
            $table->date('cheque_date')->nullable();
            $table->date('maturity_date')->nullable();
            $table->string('cheque_of_bank','33')->nullable();
            $table->bigInteger('cash_bank_ledger');
            $table->decimal('amount',20,2);
            $table->enum('journal_type',['receipt','payment','journal','contra','bank-payment']);
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','APPROVED','AUDITED','DELETED']);
            $table->enum('voucher_type',['single','multiple']);
            $table->integer('entry_by');
            $table->timestamp('entry_at')->nullable(true)->useCurrent();
            $table->integer('checked_by');
            $table->timestamp('checked_at')->nullable(true)->useCurrent();
            $table->integer('approved_by');
            $table->timestamp('approved_at')->nullable(true)->useCurrent();
            $table->integer('audited_by');
            $table->timestamp('audited_at')->nullable(true)->useCurrent();
            $table->string('deleted_reason','255');
            $table->integer('deleted_by');
            $table->timestamp('deleted_at')->nullable(true)->useCurrent();
            $table->string('ip',55)->nullable();
            $table->string('mac',55)->nullable();
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
        Schema::dropIfExists('acc_voucher_masters');
    }
};
