<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyPurchaseOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('order_id');
            $table->integer('drug_id');
            $table->float('cost', 8, 2);
            $table->float('tax', 8, 2);
            $table->float('qty', 8, 2);
            $table->float('total', 8, 2);
            $table->boolean('submitted')->default(0)->nullable();
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
        Schema::dropIfExists('pharmacy_purchase_order_items');
    }
}
