<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('order_status')->nullable();
            $table->integer('quantity');
            $table->float('price', 10, 0)->nullable();  // add 10,0
            $table->float('purchase_price', 10, 0)->nullable(); // add 10,0
            $table->string('bill_id')->nullable();
            $table->integer('purchase_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->string('use_promo')->nullable();
            $table->float('shipment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
