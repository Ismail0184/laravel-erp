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
        Schema::create('acc_contras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contra_no');
            $table->date('contra_date');
            $table->text('narration');
            $table->bigInteger('ledger_id');
            $table->bigInteger('relevant_cash_head');
            $table->double('dr_amt');
            $table->double('cr_amt');
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
        Schema::dropIfExists('acc_contras');
    }
};
