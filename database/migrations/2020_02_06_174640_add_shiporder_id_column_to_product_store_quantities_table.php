<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShiporderIdColumnToProductStoreQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_store_quantities', function (Blueprint $table) {
            $table->integer('shiporder_id')->default(1);
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
            $table->dropColumn('shiporder_id');
        });
    }
}
