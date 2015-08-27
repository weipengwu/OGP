<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventlikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventlikes', function($table){
			$table->increments('like_id');
			$table->integer('author_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eventlikes');
	}

}
