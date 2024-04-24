<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration {

	public function up()
	{
		Schema::create('portfolios', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image', 191);
			$table->tinyInteger('status')->default('1');
			$table->integer('barber_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('portfolios');
	}
}