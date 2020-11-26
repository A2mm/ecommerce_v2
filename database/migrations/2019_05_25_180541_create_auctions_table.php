<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auctions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id');
			$table->string('product_name');
			$table->float('start_price', 10, 0)->nullable();
			$table->float('best_price', 10, 0)->nullable();
			$table->date('expiry_time')->nullable();
			$table->string('main_image')->nullable();
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
		Schema::drop('auctions');
	}

}
