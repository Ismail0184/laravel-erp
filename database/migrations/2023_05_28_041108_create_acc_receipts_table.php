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
        Schema::create('acc_receipts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('receipt_no');
            $table->date('receipt_date');
            $table->text('narration');
            $table->bigInteger('ledger_id');
            $table->bigInteger('sub_ledger_id');
            $table->integer('PBI_ID');
            $table->decimal('dr_amt',20,2);
            $table->decimal('cr_amt',20,2);
            $table->enum('type',['Debit','Credit']);
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','APPROVED','AUDITED','DELETED']);
            $table->integer('entry_by');
            $table->string('ip',55);
            $table->string('mac',55);
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
        Schema::dropIfExists('acc_receipts');
    }
};
