<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
      			$table->integer('owner_id');
      			$table->string('owner_name')->nullable();
      			$table->dateTime('expiry_date')->nullable();
      			$table->string('type')->nullable();
      			$table->integer('restrict_price')->nullable();
      			$table->integer('product_id')->nullable();
      			$table->integer('discount')->nullable();
      			$table->integer('flat_rate')->nullable();
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
        Schema::dropIfExists('coupones');
    }
}
