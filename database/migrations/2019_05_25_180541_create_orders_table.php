<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->integer('product_id')->nullable();
			$table->integer('quantity');
			$table->float('price', 10, 0)->nullable();
			$table->string('bill_id')->nullable();
			$table->boolean('status')->default(0);
			$table->integer('link_id')->nullable();
			$table->integer('purchase_id')->nullable();
			//$table->string('country_code', 56)->nullable();
			$table->integer('store_id')->nullable();
			$table->integer('seller_id')->nullable();
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
		Schema::drop('orders');
	}

}
