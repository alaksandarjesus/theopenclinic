<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_drugs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('category_id');
            $table->string('name')->unique();
            $table->string('unit');
            $table->float('cost', 8, 2);
            $table->float('tax', 8, 2);
            $table->float('price', 8, 2);
            $table->float('ordered', 8, 2)->default(0)->nullable();
            $table->float('received', 8, 2)->default(0)->nullable();
            $table->float('transit', 8, 2)->default(0)->nullable();
            $table->float('invoiced', 8, 2)->default(0)->nullable();
            $table->float('purchase_returned', 8, 2)->default(0)->nullable();
            $table->float('invoice_returned', 8, 2)->default(0)->nullable();
            $table->float('in_stock', 8, 2)->default(0)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('pharmacy_drugs');
    }
}
