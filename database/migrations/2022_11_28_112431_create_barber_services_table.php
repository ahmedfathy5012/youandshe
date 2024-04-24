<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarberServicesTable extends Migration {

	public function up()
	{
		Schema::create('barber_services', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('barber_id')->unsigned();
			$table->integer('service_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('barber_services');
	}
}
