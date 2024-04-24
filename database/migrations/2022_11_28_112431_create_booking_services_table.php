<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingServicesTable extends Migration {

	public function up()
	{
		Schema::create('booking_services', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('booking_id')->unsigned();
			$table->integer('service_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('booking_services');
	}
}