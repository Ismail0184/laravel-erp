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
        Schema::create('pro_purchase_masters', function (Blueprint $table) {
            $table->id('po_no');
            $table->date('po_date');
            $table->string('po_subject');
            $table->text('po_details');
            $table->string('quotation_no');
            $table->date('quotation_date');
            $table->integer('vendor_id');
            $table->integer('warehouse_id');
            $table->double('tax');
            $table->double('vat');
            $table->enum('po_type',['Product','Asset','Stationary','Others']);
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','RECOMMENDED','PROCESSING','COMPLETED','DELETED']);
            $table->timestamp('entry_at')->nullable(true)->useCurrent();
            $table->integer('checked_by');
            $table->timestamp('checked_at')->nullable(true)->useCurrent();
            $table->integer('approved_by');
            $table->timestamp('approved_at')->nullable(true)->useCurrent();
            $table->integer('audited_by');
            $table->timestamp('audited_at')->nullable(true)->useCurrent();
            $table->string('deleted_resone','255');
            $table->integer('deleted_by');
            $table->timestamp('deleted_at')->nullable(true)->useCurrent();
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
        Schema::dropIfExists('pro_purchase_masters');
    }
};
