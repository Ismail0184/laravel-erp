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
            $table->string('po_subject')->nullable();
            $table->text('po_details')->nullable();
            $table->string('quotation_no')->nullable();
            $table->date('quotation_date')->nullable();;
            $table->integer('vendor_id');
            $table->integer('warehouse_id');
            $table->double('tax')->nullable();
            $table->double('vat')->nullable();
            $table->enum('po_type',['WO','DP','Asset','Stationary','Others']);
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','RECOMMENDED','PROCESSING','COMPLETED','AUDITED','DELETED']);
            $table->integer('entry_by');
            $table->timestamp('entry_at')->nullable(true)->useCurrent();
            $table->integer('checked_by')->nullable()->nullable();
            $table->timestamp('checked_at')->nullable(true)->useCurrent();
            $table->integer('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable(true)->useCurrent();
            $table->integer('audited_by')->nullable();;
            $table->timestamp('audited_at')->nullable(true)->useCurrent();
            $table->string('deleted_reason','255')->nullable();;
            $table->integer('deleted_by')->nullable();;
            $table->timestamp('deleted_at')->nullable(true)->useCurrent();
            $table->string('ip',55)->nullable();;
            $table->string('mac',55)->nullable();;
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
