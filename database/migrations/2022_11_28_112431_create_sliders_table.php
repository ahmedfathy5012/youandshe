<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration {

	public function up()
	{
		Schema::create('sliders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('image')->nullable();
			$table->integer('barber_id')->unsigned()->nullable();
			$table->text('link')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('sliders');
	}
}