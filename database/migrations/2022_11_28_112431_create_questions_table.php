<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('question')->nullable();
			$table->text('answer')->nullable();
			$table->tinyInteger('for_who')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}
}