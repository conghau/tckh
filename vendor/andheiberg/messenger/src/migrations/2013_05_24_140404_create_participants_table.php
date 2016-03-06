<?php

use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('web_pm_participants', function($table)
		{
			$table->increments('id');
			$table->integer('conversation_id')->unsigned();
			$table->integer('user_id');
			$table->timestamp('last_read');
			$table->timestamps();

			$table->foreign('conversation_id')->references('id')->on('web_pm_conversations');
			$table->foreign('user_id')->references('id')->on('web_users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('web_pm_participants');
	}

}