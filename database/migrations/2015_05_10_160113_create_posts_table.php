<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table){
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->string('banner');
			$table->text('content');
			$table->string('featured');
			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
			$table->integer('author')->unsigned();
			$table->foreign('author')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('posts');
	}

}
