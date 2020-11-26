<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('unique_id')->nullable();
			$table->string('name')->nullable();
			$table->integer('category_id')->default(16);
			$table->integer('subcategory_id')->nullable();
			$table->string('discount')->nullable();
			$table->integer('local_discount')->nullable();
			$table->boolean('status')->default(1);
			$table->text('slug', 65535)->nullable();
			$table->integer('quantity');
			$table->integer('num_of_orders')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('archive')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
