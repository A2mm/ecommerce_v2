<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_competitions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->unsigned();
			$table->integer('competition_id');
			$table->text('unique_idtfr', 65535);
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
		Schema::drop('user_competitions');
	}

}
