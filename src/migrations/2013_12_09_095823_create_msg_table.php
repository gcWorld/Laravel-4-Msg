<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('msg', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('from');
			$table->integer('to');
			$table->boolean('read');
			$table->string('subject');
			$table->text('message');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('msg');
	}

}
