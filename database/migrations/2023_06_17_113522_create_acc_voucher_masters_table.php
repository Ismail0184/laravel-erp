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
            $table->double('ledger_balance')->nullable();
            $table->decimal('amount',20,2);
            $table->enum('journal_type',['receipt','payment','journal','contra','cheque','sales','purchase','supporting','credit','debit']);
            $table->string('journal_type_definition')->nullable();
            $table->enum('status',['MANUAL','UNCHECKED','REJECTED','CHECKED','APPROVED','AUDITED','DELETED']);
            $table->enum('voucher_type',['single','multiple']);
            $table->integer('entry_by');
            $table->timestamp('entry_at')->nullable(true)->useCurrent();

            $table->timestamp('checker_person_viewed_at')->nullable(true);
            $table->enum('checked_status',['PENDING','CHECKED','REJECTED'])->default('PENDING');
            $table->string('remarks_while_checked')->nullable();
            $table->integer('checked_by');
            $table->timestamp('checked_at')->nullable(true)->useCurrent();

            $table->timestamp('approving_person_viewed_at')->nullable(true);
            $table->enum('approved_status',['PENDING','APPROVED','REJECTED'])->default('PENDING');
            $table->string('remarks_while_approved')->nullable();
            $table->integer('approved_by');
            $table->timestamp('approved_at')->nullable(true)->useCurrent();

            $table->timestamp('auditing_person_viewed_at')->nullable(true);
            $table->enum('audited_status',['PENDING','AUDITED','REJECTED'])->default('PENDING');
            $table->string('remarks_while_audited')->nullable();
            $table->integer('audited_by');
            $table->timestamp('audited_at')->nullable(true)->useCurrent();

            $table->string('deleted_reason','255');
            $table->integer('deleted_by');
            $table->timestamp('deleted_at')->nullable(true)->useCurrent();

            $table->string('ip',55)->nullable();
            $table->string('mac',55)->nullable();
            $table->integer('visible_status')->default('1');
            $table->enum('amount_equality',['IMBALANCED','BALANCED'])->default('IMBALANCED');
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
