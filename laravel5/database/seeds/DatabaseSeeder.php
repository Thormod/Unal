<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create([
        	'name' => 'Thormod Tyrsson',
        	'admin' => 1,
        	'email' => 'thor@gmail.com',
        	'password' => Hash::make('pass'),

        ]);

        User::create([
        	'name' => 'Sebastian Zapata',
        	'admin' => 0,
        	'email' => 'sebas@gmail.com',
        	'password' => Hash::make('pass'),
        ]);
    }

}
