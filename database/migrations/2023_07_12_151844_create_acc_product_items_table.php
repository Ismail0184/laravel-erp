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
        Schema::create('acc_product_items', function (Blueprint $table) {
            $table->id('item_id')->unique();
            $table->integer('serial');
            $table->string('custom_id')->unique()->nullable();
            $table->string('item_name')->unique();
            $table->text('item_description');
            $table->enum('consumable_type',['Consumable','Non-Consumable','Service']);
            $table->enum('product_nature',['Salable','Purchasable','Both']);
            $table->bigInteger('sub_group_id');
            $table->integer('unit');
            $table->integer('brand_id');
            $table->integer('pack_unit');
            $table->integer('sub_pack_size');
            $table->integer('pack_size')->nullable();
            $table->double('g_weight')->nullable();
            $table->double('p_price')->nullable();
            $table->double('c_price')->nullable();
            $table->double('s_price')->nullable();
            $table->double('f_price')->nullable();
            $table->double('d_price')->nullable();
            $table->double('t_price')->nullable();
            $table->double('m_price')->nullable();
            $table->double('production_cost')->nullable();
            $table->double('material_cost')->nullable();
            $table->double('conversion_cost')->nullable();
            $table->double('SD')->nullable();
            $table->integer('SD_percentage')->nullable();
            $table->double('VAT')->nullable();
            $table->integer('VAT_percentage')->nullable();
            $table->integer('re_purchase_level')->nullable();
            $table->integer('shelf_life')->nullable();
            $table->integer('H_S_code')->nullable();
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
        Schema::dropIfExists('acc_product_items');
    }
};
