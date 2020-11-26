<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDigitalProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('digital_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->text('description', 65535)->nullable();
			$table->string('link');
			$table->float('price', 10, 0);
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
		Schema::drop('digital_products');
	}

}
