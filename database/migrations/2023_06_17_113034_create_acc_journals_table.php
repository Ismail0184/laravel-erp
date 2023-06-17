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
            $table->text('narration');
            $table->bigInteger('ledger_id');
            $table->bigInteger('relevant_cash_head');
            $table->double('dr_amt');
            $table->double('cr_amt');
            $table->integer('cc_code');
            $table->enum('type',['Debit','Credit']);
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','APPROVED','AUDITED','DELETED']);
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
        Schema::dropIfExists('acc_journals');
    }
};
