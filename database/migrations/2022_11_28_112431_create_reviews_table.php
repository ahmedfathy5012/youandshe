<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('comment')->nullable();
			$table->tinyInteger('rate')->default(0);
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('barber_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}