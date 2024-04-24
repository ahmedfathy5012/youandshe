<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration {

	public function up()
	{
		Schema::create('blogs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image', 191)->nullable();
			$table->mediumText('title')->nullable();
			$table->longText('body')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('blogs');
	}
}