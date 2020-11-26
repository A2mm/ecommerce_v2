<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('slug');
			$table->integer('user_id');
			$table->integer('product_id');
			$table->integer('visits')->default(0);
			$table->integer('orders')->default(0);
			$table->text('block_message', 65535)->nullable();
			$table->boolean('status')->default(1);
			$table->string('qr_slug')->nullable();
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
		Schema::drop('links');
	}

}
