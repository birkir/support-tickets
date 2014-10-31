<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_messages', function(Blueprint $table)
		{
			$table->increments('id');

			// Relationships
			$table->integer('ticket_id');
			$table->integer('user_id');

			// Schema
			$table->text('message');

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
		Schema::drop('ticket_messages');
	}

}
