<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('code');
			$table->integer('owner_id');
			$table->string('owner_name')->nullable();
			$table->dateTime('expiry_date')->nullable();
			$table->string('type');
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
		Schema::drop('coupons');
	}

}
