<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsagesTable extends Migration {

	public function up()
	{
		Schema::create('usages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('text')->nullable();
			$table->tinyInteger('for_who')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('usages');
	}
}