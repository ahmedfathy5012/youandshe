<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration {

	public function up()
	{
		Schema::create('services', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191);
			$table->string('icon', 191)->nullable();
			$table->smallInteger('duration')->default(0);
			$table->smallInteger('status')->default(0);
			$table->double('price')->default(0);
			$table->tinyInteger('gender')->default(config('constants.gender')['man'])->nullable();
		});
	}

	public function down()
	{
		Schema::drop('services');
	}
}
