<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAccountMeta extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_meta', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->string('meta_key');
            $table->text('meta_value');
            $table->tinyInteger('meta_type');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('account_meta');
	}

}
