<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('address', 65535)->nullable();
			$table->string('city')->nullable();
			$table->string('street')->nullable();
			$table->string('vendor_name')->nullable();
			$table->text('fax', 65535)->nullable();
			$table->string('lt')->nullable();
			$table->string('lg')->nullable();
			$table->text('phone', 65535)->nullable();
			$table->string('logo')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('slug', 50)->nullable();
			$table->string('color', 50)->nullable();
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
		Schema::drop('vendors');
	}

}
