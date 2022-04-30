<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('order_number')->unique();
            $table->date('order_date')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('items_count')->default(0)->nullable();
            $table->float('subtotal', 8, 2);
            $table->float('tax', 8, 2);
            $table->float('discount', 8, 2);
            $table->float('total', 8, 2);
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('pharmacy_purchase_orders');
    }
}
