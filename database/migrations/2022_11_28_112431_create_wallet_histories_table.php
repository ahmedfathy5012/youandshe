<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateWalletHistoriesTable extends Migration {

	public function up()
	{
		Schema::create('wallet_histories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->tinyInteger('transaction_type')->default(0);
			$table->double('amount')->default('0.0');
			$table->integer('barber_id')->unsigned()->nullable();
			$table->integer('booking_id')->unsigned()->nullable();
			$table->float('percentage')->default('0.0');
		});
	}

	public function down()
	{
		Schema::drop('wallet_histories');
	}
}
