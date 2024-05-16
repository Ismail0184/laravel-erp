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
        Schema::create('acc_journals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('journal_no');
            $table->date('journal_date');
            $table->text('narration')->nullable()->default('N/A');
            $table->bigInteger('ledger_id');
            $table->bigInteger('relevant_cash_head')->nullable();
            $table->double('dr_amt');
            $table->double('cr_amt');
            $table->double('balance')->nullable();
            $table->integer('cc_code');
            $table->enum('type',['Debit','Credit']);
            $table->text('journal_attachment')->nullable();
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','APPROVED','AUDITED','DELETED']);
            $table->integer('entry_by');
            $table->integer('visible_status')->default('1');
            $table->integer('company_id')->default(0);
            $table->integer('group_id')->default(0);
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
        Schema::dropIfExists('acc_journals');
    }
};
