<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        // Clear account table
        DB::table('account')->truncate();

		$this->call('AccountTableSeeder');
	}

}
