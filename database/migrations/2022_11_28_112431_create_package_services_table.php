<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageServicesTable extends Migration {

	public function up()
	{
		Schema::create('package_services', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('package_id')->unsigned();
			$table->integer('service_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('package_services');
	}
}