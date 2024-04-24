<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration {

	public function up()
	{
		Schema::create('coupons', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('coupon', 191);
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->float('discount')->default(0.0);
			$table->tinyInteger('is_percentage')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('coupons');
	}
}
