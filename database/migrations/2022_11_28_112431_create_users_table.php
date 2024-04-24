<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191);
			$table->string('password', 191);
			$table->string('phone', 191)->unique();
			$table->string('device_id', 191)->nullable();
			$table->string('device_token', 191)->nullable();
			$table->string('api_token', 191)->nullable();
			$table->boolean('phone_verify')->default(false);
			$table->tinyInteger('gender')->default(0);
			$table->smallInteger('status')->default(0);
			$table->string('image', 191)->nullable();
			$table->integer('state_id')->unsigned()->nullable();
			$table->integer('city_id')->unsigned()->nullable();
			$table->tinyInteger('service_gender')->default(0);
			$table->tinyInteger('ready_to_notify')->default(1);
			$table->string('activate_code', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
