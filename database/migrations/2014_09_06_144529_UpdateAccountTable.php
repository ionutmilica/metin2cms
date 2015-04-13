<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /* We create the table more for testing reason, because every server should have a database */

        if ( ! Schema::hasTable('account'))
        {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/account.sql'));
        }

        Schema::table('account', function (Blueprint $table)
        {
            $table->string('confirmation_token', 64)->nullable();
            $table->string('remember_token')->nullable();
            // here add new fields if needed
        });

    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('account', function (Blueprint $table)
        {
            // here we delete the columns created in migration
            // ex: $table->dropColumn('votes');
            $table->dropColumn('confirmation_token');
            $table->dropColumn('remember_token');
        });
	}

}
