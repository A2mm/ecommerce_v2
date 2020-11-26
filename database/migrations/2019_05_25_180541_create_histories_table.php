<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('histories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->integer('product_id')->nullable();
			$table->string('order_status')->nullable();
			$table->integer('quantity');
			$table->float('price', 10, 0)->nullable();
			$table->string('bill_id')->nullable();
			$table->integer('order_id')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('purchase_id')->nullable();
			//$table->string('country_code', 56);
			$table->integer('store_id')->nullable();
			$table->integer('seller_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('histories');
	}

}
