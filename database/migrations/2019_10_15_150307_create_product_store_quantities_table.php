<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStoreQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('product_store_quantities', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('product_store_id');
            $table->integer('product_id');
            $table->integer('store_id');
            $table->integer('purchase_id')->nullable();
            $table->integer('quantity');
            $table->longtext('reason')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('product_store_quantities');
    }
}
