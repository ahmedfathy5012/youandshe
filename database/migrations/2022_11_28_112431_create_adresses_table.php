<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration {

	public function up()
	{
		Schema::create('adresses', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('address', 191)->nullable();
			$table->double('lat')->nullable();
			$table->double('lon')->nullable();
			$table->string('name');
			$table->integer('address_type_id')->unsigned()->nullable();
			$table->tinyInteger('status');
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('adresses');
	}
}