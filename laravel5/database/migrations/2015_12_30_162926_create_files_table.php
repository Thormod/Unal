<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('files', function(Blueprint $table)
		{
			/* File ID */
            $table->increments('id');
            /* File FOLDER */
            $table->integer('folder_id');
            /* File NAME */
            $table->string('file_name');
            /* File TYPE */
            $table->string('file_type');
            /* Fie NICKNAME */
            $table->string('file_nickname');
            /* File SIZE */
            $table->string('file_size',10);
            /* File MIME */
            $table->string('file_mime',50);
            /* File PATH */
            $table->string('file_path');
            /* File STATUS */
            $table->boolean('status');
            /* File AUTHOR */
            $table->integer('created_by');
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
		Schema::drop('files');
	}

}
