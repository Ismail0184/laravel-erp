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
        Schema::create('sal_dealer_infos', function (Blueprint $table) {
            $table->id('dealer_id');
            $table->string('serial')->nullable();
            $table->string('dealer_custom_id','55')->nullable();
            $table->string('dealer_name','255');
            $table->string('proprietor_name','155')->nullable();
            $table->string('mobile','33')->nullable();
            $table->string('email','33')->nullable();
            $table->string('contact_person','100')->nullable();
            $table->string('contact_person_designation','55')->nullable();
            $table->string('contact_person_mobile','33')->nullable();
            $table->text('address')->nullable();
            $table->string('nid')->nullable();
            $table->string('passport')->nullable();
            $table->string('TIN')->nullable();
            $table->string('BIN')->nullable();
            $table->bigInteger('ledger_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('territory_id')->nullable();
            $table->integer('town_id')->nullable();
            $table->integer('cat_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->double('commission')->nullable();
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
        Schema::dropIfExists('sal_dealer_infos');
    }
};
