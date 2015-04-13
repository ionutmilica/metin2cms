<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /* We create the table more for testing reason, because every server should have a database */

        if ( ! Schema::connection('player')->hasTable('player'))
        {
            DB::connection('player')->unprepared(file_get_contents(__DIR__ . '/sql/player.sql'));
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
