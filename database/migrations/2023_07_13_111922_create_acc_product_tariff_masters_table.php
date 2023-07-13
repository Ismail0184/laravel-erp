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
        Schema::create('acc_product_tariff_masters', function (Blueprint $table) {
            $table->id();
            $table->string('H_S_code','33')->unique();
            $table->text('description')->nullable();
            $table->string('product_example','55')->nullable();
            $table->double('CD')->nullable();
            $table->double('RD')->nullable();
            $table->double('SD')->nullable();
            $table->double('VAT')->nullable();
            $table->double('AIT')->nullable();
            $table->double('ATV')->nullable();
            $table->double('TTI')->nullable();
            $table->double('Tariff_Section_Record_Value_in_USD')->nullable();
            $table->integer('unit_id')->nullable();
            $table->enum('status',['active','inactive','suspended','deleted']);
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
        Schema::dropIfExists('acc_product_tariff_masters');
    }
};
