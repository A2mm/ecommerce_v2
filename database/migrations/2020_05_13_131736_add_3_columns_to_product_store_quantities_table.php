<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add3ColumnsToProductStoreQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_store_quantities', function (Blueprint $table) {
             $table->integer('transfer_id')->nullable();
             $table->integer('from_store')->nullable();
             $table->integer('to_store')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_store_quantities', function (Blueprint $table) {
            //
        });
    }
}
