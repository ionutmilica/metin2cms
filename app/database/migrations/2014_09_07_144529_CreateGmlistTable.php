<?php

use Illuminate\Database\Migrations\Migration;

class CreateGmlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if ( ! Schema::connection('common')->hasTable('gmlist')) {
            DB::connection('common')->unprepared(file_get_contents(__DIR__ . '/sql/common.sql'));
        }
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
