<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostlikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postlikes', function($table){
			$table->increments('like_id');
			$table->integer('author_id')->unsigned();
			$table->integer('post_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('postlikes');
	}

}
