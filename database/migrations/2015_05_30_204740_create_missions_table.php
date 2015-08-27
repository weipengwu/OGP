<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('missions', function($table){
			$table->increments('id');
			$table->string('author');
			$table->string('slug');
			$table->string('title');
			$table->integer('group_id')->unsigned();
			$table->string('fromtime');
			$table->string('totime');
			$table->string('city');
			$table->string('address');
			$table->string('bounty');
			$table->text('content');
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
		Schema::drop('missions');
	}

}
