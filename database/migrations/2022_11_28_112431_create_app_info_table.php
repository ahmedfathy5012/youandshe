<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppInfoTable extends Migration {

	public function up()
	{
		Schema::create('app_info', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('face', 191)->nullable();
			$table->string('insta', 191)->nullable();
			$table->string('YouTube', 191)->nullable();
			$table->string('twitter', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('phone', 13)->nullable();
			$table->tinyInteger('app_status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('app_info');
	}
}