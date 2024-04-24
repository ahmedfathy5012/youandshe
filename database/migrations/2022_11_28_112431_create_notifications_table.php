<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('title')->nullable();
			$table->text('body');
			$table->integer('booking_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}