<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth', function($table) {
			$table->increments('id');
			$table->integer('xf_id');
			$table->string('sa_username');
			$table->dateTime('linked_at');
		});

		Schema::create('auth_token', function($table) {
			$table->increments('id');
			$table->integer('xf_id');
			$table->string('token');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('auth');
		Schema::drop('auth_token');
	}

}
