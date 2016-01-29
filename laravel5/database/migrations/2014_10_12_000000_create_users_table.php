<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			/* User ID */
            $table->increments('id');
            /* User FIRST_NAME */
            $table->string('name');
            /* User PERMISSIONS */
            $table->boolean('admin');
            /* User EMAIL */
            $table->string('email')->unique();
            /* User PASSWORD */
            $table->string('password', 60);
            /* User REMEBER TOKEN */
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
