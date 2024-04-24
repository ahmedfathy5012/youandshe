<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTypesTable extends Migration {

	public function up()
	{
		Schema::create('address_types', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191);
			$table->text('icon')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('address_types');
	}
}