<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sponsors', function($table) {
			$table->increments('id');
			$table->integer('auth_id');
			$table->integer('sponsor_id');
		});

		Schema::create('characters', function($table) {
			$table->increments('id');
			$table->integer('auth_id');
			$table->string('name');
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
		Schema::drop('sponsors');
		Schema::drop('characters');
	}

}
