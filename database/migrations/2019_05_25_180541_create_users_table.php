<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->nullable();
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->string('api_token')->nullable();
			$table->string('role')->nullable()->default('user');
			$table->boolean('status')->default(1);
			$table->string('code')->nullable();
			$table->integer('points')->default(0);
			$table->integer('country_id')->nullable()->default(243);
			$table->integer('usertype_id')->nullable();
			$table->string('prev_privillige', 56)->nullable();
			$table->text('city', 65535)->nullable();
			$table->text('address', 65535)->nullable();
			$table->text('phone')->nullable();
			$table->string('new_email')->nullable();
			$table->string('new_name')->nullable();
			$table->text('payee_name', 65535)->nullable();
			$table->text('bank_account', 65535)->nullable();
			$table->string('language')->nullable();
			$table->string('hoppy')->nullable();
			$table->boolean('sex')->nullable();
			$table->string('job')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('facebook_id')->nullable();
			$table->integer('customerOrNot')->default(0);
			$table->softDeletes();
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
		Schema::drop('users');
	}

}
