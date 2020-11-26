<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->string('purchaser')->nullable();
			$table->text('delivery_address', 65535);
			$table->text('billing_address', 65535);
			$table->text('receptor_mobile', 65535);
			$table->text('buyer_mobile', 65535);
			$table->string('receptor_name')->nullable();
			$table->float('price', 10, 0);
			$table->string('method')->nullable();
			$table->string('purchase_status')->nullable();
			$table->text('note', 65535)->nullable();
			$table->string('bill_id')->nullable();
			$table->integer('store_id')->nullable();
			$table->integer('seller_id')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('shipment')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('purchases');
	}

}
