<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191)->nullable();
			$table->string('phone')->nullable();
			$table->string('password', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}
}