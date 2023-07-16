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
        Schema::create('pro_purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('po_no');
            $table->date('po_date');
            $table->integer('vendor_id');
            $table->bigInteger('item_id');
            $table->text('item_details');
            $table->integer('warehouse_id');
            $table->double('qty');
            $table->double('rate');
            $table->double('amount');
            $table->enum('po_type',['WO','DP','Asset','Stationary','Others']);
            $table->enum('status',['MANUAL','UNCHECKED','CHECKED','RECOMMENDED','PROCESSING','COMPLETED','DELETED']);
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
        Schema::dropIfExists('pro_purchase_invoices');
    }
};
