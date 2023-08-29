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
        Schema::create('sal_trade_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name','255');
            $table->bigInteger('buy_item_id');
            $table->double('buy_item_qty');
            $table->bigInteger('gift_item_id');
            $table->double('gift_item_qty');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['active','inactive','suspended','deleted']);
            $table->enum('calculation_mode',['auto','manual']);
            $table->enum('gift_type',['cash','non-cash','free_own_products','free_other_SKU','free_other_products']);
            $table->integer('dealer_id')->nullable();
            $table->integer('dealer_type');
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
        Schema::dropIfExists('sal_trade_schemes');
    }
};
