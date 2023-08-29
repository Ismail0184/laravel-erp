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
        Schema::create('sal_dealer_credit_limits', function (Blueprint $table) {
            $table->id();
            $table->integer('dealer_id');
            $table->double('current_balance');
            $table->double('requested_limit');
            $table->double('approved_limit');
            $table->text('remarks')->nullable();
            $table->text('approved_remarks')->nullable();
            $table->integer('entry_by');
            $table->integer('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable(true)->useCurrent();
            $table->enum('status',['UNAPPROVED','APPROVED','REJECTED','HOLD','deleted']);
            $table->enum('limit_type',['SINGLE','UNLIMITED']);
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
        Schema::dropIfExists('sal_dealer_credit_limits');
    }
};
