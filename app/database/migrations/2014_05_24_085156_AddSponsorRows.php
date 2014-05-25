<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSponsorRows extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('auth', function($table) {
			$table->boolean('is_sponsored')->default(false);
			$table->string('xf_username')->nullable();
		});

		Schema::table('characters', function($table) {
			$table->boolean('is_main')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('auth', function($table) {
			$table->dropColumn(array('is_sponsored','xf_username'));
		});

		Schema::table('characters', function($table) {
			$table->dropColumn('is_main');
		});
	}

}
