<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration {

	public function up()
	{
		Schema::create('states', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191);
		});
	}

	public function down()
	{
		Schema::drop('states');
	}
}