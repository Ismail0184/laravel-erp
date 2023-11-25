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
        Schema::create('hrm_employee_document_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('category_id');
            $table->string('doc_title')->nullable();
            $table->string('doc_id')->nullable();
            $table->text('doc_file')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('entry_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('hrm_employee_document_infos');
    }
};
