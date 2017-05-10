<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('display_id')->nullable();
			$table->decimal('total', 7);
			$table->string('name');
			$table->string('telephone');
			$table->string('email')->nullable();
			$table->string('facebook')->nullable();
			$table->text('address', 65535)->nullable();
			$table->string('province')->nullable();
			$table->string('postal')->nullable();
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
		Schema::drop('orders');
	}

}
