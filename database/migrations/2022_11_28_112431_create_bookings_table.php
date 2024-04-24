<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration {

	public function up()
	{
		Schema::create('bookings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('barber_id')->unsigned()->nullable();
			$table->date('date')->nullable();
			$table->time('time')->nullable();
			$table->double('price')->default(0);
			$table->tinyInteger('status')->default(0)->nullable();
			$table->double('discount')->default(0);
			$table->double('total')->default(0);
			$table->integer('address_id')->unsigned()->nullable();
			$table->integer('package_id')->unsigned()->nullable();
			$table->integer('coupon_id')->unsigned()->nullable();
			$table->integer('cancel_reason_id')->unsigned()->nullable();
			$table->text('cancel_reason_title')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('bookings');
	}
}
