<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('package_services', function(Blueprint $table) {
			$table->foreign('package_id')->references('id')->on('services')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('package_services', function(Blueprint $table) {
			$table->foreign('service_id')->references('id')->on('services')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('adresses', function(Blueprint $table) {
			$table->foreign('address_type_id')->references('id')->on('address_types')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('adresses', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('barbers', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('barbers', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('barbers', function(Blueprint $table) {
			$table->foreign('address_id')->references('id')->on('adresses')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('portfolios', function(Blueprint $table) {
			$table->foreign('barber_id')->references('id')->on('barbers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('barber_services', function(Blueprint $table) {
			$table->foreign('barber_id')->references('id')->on('barbers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('barber_services', function(Blueprint $table) {
			$table->foreign('service_id')->references('id')->on('services')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('barber_id')->references('id')->on('barbers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('booking_id')->references('id')->on('bookings')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('barber_id')->references('id')->on('barbers')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('address_id')->references('id')->on('adresses')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('package_id')->references('id')->on('packages')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('coupon_id')->references('id')->on('coupons')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->foreign('cancel_reason_id')->references('id')->on('cancel_reasons')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('booking_services', function(Blueprint $table) {
			$table->foreign('booking_id')->references('id')->on('bookings')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('booking_services', function(Blueprint $table) {
			$table->foreign('service_id')->references('id')->on('services')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('sliders', function(Blueprint $table) {
			$table->foreign('barber_id')->references('id')->on('barbers')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('wallet_histories', function(Blueprint $table) {
			$table->foreign('barber_id')->references('id')->on('barbers')
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table('wallet_histories', function(Blueprint $table) {
			$table->foreign('booking_id')->references('id')->on('bookings')
						->onDelete('set null')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_state_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_city_id_foreign');
		});
		Schema::table('package_services', function(Blueprint $table) {
			$table->dropForeign('package_services_package_id_foreign');
		});
		Schema::table('package_services', function(Blueprint $table) {
			$table->dropForeign('package_services_service_id_foreign');
		});
		Schema::table('adresses', function(Blueprint $table) {
			$table->dropForeign('adresses_address_type_id_foreign');
		});
		Schema::table('adresses', function(Blueprint $table) {
			$table->dropForeign('adresses_user_id_foreign');
		});
		Schema::table('barbers', function(Blueprint $table) {
			$table->dropForeign('barbers_state_id_foreign');
		});
		Schema::table('barbers', function(Blueprint $table) {
			$table->dropForeign('barbers_city_id_foreign');
		});
		Schema::table('barbers', function(Blueprint $table) {
			$table->dropForeign('barbers_address_id_foreign');
		});
		Schema::table('portfolios', function(Blueprint $table) {
			$table->dropForeign('portfolios_barber_id_foreign');
		});
		Schema::table('barber_services', function(Blueprint $table) {
			$table->dropForeign('barber_services_barber_id_foreign');
		});
		Schema::table('barber_services', function(Blueprint $table) {
			$table->dropForeign('barber_services_service_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_user_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('reviews_barber_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_booking_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_user_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_barber_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_address_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_package_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_coupon_id_foreign');
		});
		Schema::table('bookings', function(Blueprint $table) {
			$table->dropForeign('bookings_cancel_reason_id_foreign');
		});
		Schema::table('booking_services', function(Blueprint $table) {
			$table->dropForeign('booking_services_booking_id_foreign');
		});
		Schema::table('booking_services', function(Blueprint $table) {
			$table->dropForeign('booking_services_service_id_foreign');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_state_id_foreign');
		});
		Schema::table('sliders', function(Blueprint $table) {
			$table->dropForeign('sliders_barber_id_foreign');
		});
		Schema::table('wallet_histories', function(Blueprint $table) {
			$table->dropForeign('wallet_histories_barber_id_foreign');
		});
		Schema::table('wallet_histories', function(Blueprint $table) {
			$table->dropForeign('wallet_histories_booking_id_foreign');
		});
	}
}
