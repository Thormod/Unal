<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFolderPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('folder_permissions', function(Blueprint $table)
		{
			$table->increments('id');
            /* Folder ID */
            $table->integer('folder_id');
            /* User ID */
            $table->integer('user_id');
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
		Schema::drop('folder_permissions');
	}

}
