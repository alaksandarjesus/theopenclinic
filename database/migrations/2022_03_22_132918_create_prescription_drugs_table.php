<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_drugs', function (Blueprint $table) {
            $table->id();
            $table->integer('prescription_id');
            $table->integer('drug_id');
            $table->integer('days');
            $table->integer('bb');
            $table->integer('ab');
            $table->integer('bl');
            $table->integer('al');
            $table->integer('be');
            $table->integer('ae');
            $table->integer('bd');
            $table->integer('ad');
            $table->integer('created_by')->default(1)->nullable();
            $table->integer('updated_by')->default(1)->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('prescription_drugs');
    }
}
