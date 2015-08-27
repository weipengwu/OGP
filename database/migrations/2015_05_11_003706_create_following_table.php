<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('following', function($table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('followed_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('followed_id')->references('id')->on('groups')->onDelete('cascade');
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
		Schema::drop('following');
	}

}
