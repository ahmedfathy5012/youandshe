<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration {

	public function up()
	{
		Schema::create('packages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 191);
			$table->double('price')->default(0);
			$table->string('icon', 191)->nullable();
            $table->tinyInteger('gender')->default(config('constants.gender')['man'])->nullable();
		});
	}

	public function down()
	{
		Schema::drop('packages');
	}
}
