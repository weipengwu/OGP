<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($table){
			$table->increments('id');
			$table->string('slug');
			$table->string('author');
			$table->string('title');
			$table->integer('group_id')->unsigned();
			$table->string('fromtime');
			$table->string('totime');
			$table->string('city');
			$table->string('address');
			$table->string('type');
			$table->string('fee');
			$table->text('content');
			$table->string('banner');
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
		Schema::drop('events');
	}

}
