<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('b_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('unique_id')->nullable();
			$table->string('name')->nullable();
			$table->string('arabic_name')->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('arabic_description', 65535)->nullable();
			$table->string('main_image')->nullable();
			$table->string('image_1')->nullable();
			$table->string('image_2')->nullable();
			$table->string('image_3')->nullable();
			$table->integer('subcategory_id')->nullable();
			$table->float('price', 10, 0)->nullable();
			$table->string('discount')->nullable();
			$table->integer('supplier_id')->nullable();
			$table->float('view_cost', 10, 0)->nullable();
			$table->float('order_cost', 10, 0)->nullable();
			$table->text('slug', 65535)->nullable();
			$table->integer('category_id')->nullable();
			$table->integer('accessory_id')->nullable();
			$table->integer('currency_id')->nullable();
			$table->boolean('in_auction')->nullable()->default(0);
			$table->string('watermark')->nullable()->default('white');
			$table->string('weight')->nullable();
			$table->string('dimensions')->nullable();
			$table->integer('num_of_orders')->nullable();
			$table->integer('minimum_order')->nullable();
			$table->integer('supplier_ability')->nullable();
			$table->text('country', 65535)->nullable();
			$table->boolean('status')->default(1);
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
		Schema::drop('b_products');
	}

}
