<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_infos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('title')->nullable();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('citizen_id')->nullable();
			$table->string('student_id')->nullable();
			$table->string('gender')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('tel')->nullable();
			$table->string('tel_alt')->nullable();
			$table->integer('user_type_id')->unsigned()->nullable();
			$table->integer('university_id')->unsigned()->nullable();
			$table->integer('department_id')->unsigned()->nullable();
			$table->string('document')->nullable();
			$table->string('pic')->nullable();
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
		Schema::drop('user_infos');
	}

}
