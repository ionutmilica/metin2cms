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
        if ( ! Schema::hasTable('account'))
        {
            /* We create the table more for testing reason, because every server should have a database */

            $sql = file_get_contents(__DIR__ . '/sql/account.sql');
            DB::statement($sql);
        }
        else
        {
            Schema::table('account', function (Blueprint $table)
            {
                $table->string('confirmation_token', 64);
                // here add new fields if needed
            });
        }
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
        });
	}

}
