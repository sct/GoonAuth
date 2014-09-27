<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserLock extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('characters', function($table) {
			$table->boolean('locked')->default(0);
		});

		Schema::table('auth', function($table) {
			$table->boolean('is_banned')->default(0);
		});

		Schema::create('blacklist', function($table){
			$table->increments('id');
			$table->integer('auth_id');
			$table->string('sa_username');
			$table->text('reason');
			$table->timestamps();
		});

		Schema::create('notes', function($table) {
			$table->increments('id');
			$table->integer('auth_id');
			$table->integer('admin_id');
			$table->text('note');
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
		Schema::table('characters', function($table) {
			$table->dropColumn('locked');
		});

		Schema::table('auth', function($table) {
			$table->dropColumn(array('is_banned'));
		});

		Schema::drop('blacklist');
		Schema::drop('notes');
	}

}
