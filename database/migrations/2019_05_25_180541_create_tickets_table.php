<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('slug')->nullable();
			$table->text('title', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('user_id');
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('closed_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
