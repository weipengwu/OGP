<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function($table){
			$table->increments('id');
			$table->string('creator');
			$table->string('owner');
			$table->string('name');
			$table->string('slug');
			$table->string('profile');
			$table->string('banner');
			$table->string('category');
			$table->string('tag');
			$table->string('website');
			$table->string('type');
			$table->string('applytojoin');
			$table->text('description');
			$table->string('featured');
			$table->string('verified');
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
		Schema::drop('groups');
	}

}
