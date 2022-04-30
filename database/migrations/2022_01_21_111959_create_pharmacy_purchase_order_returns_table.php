<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyPurchaseOrderReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_purchase_order_returns', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('purchase_order_inventory_id');
            $table->float('cost', 8, 2);
            $table->float('tax', 8, 2);
            $table->float('qty', 8, 2);
            $table->float('total', 8, 2);
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('pharmacy_purchase_order_returns');
    }
}
