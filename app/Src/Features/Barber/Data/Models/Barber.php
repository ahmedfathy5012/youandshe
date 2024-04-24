<?php

namespace Src\Features\Barber\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Src\Features\Auth\Data\Models\User;
use Src\Features\BaseApp\Data\Models\Address;
use Src\Features\BaseApp\Data\Models\Service;
use Src\Features\Booking\Data\Models\Booking;
use Src\Features\Location\Data\Models\City;
use Src\Features\Location\Data\Models\State;

class Barber extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'barbers';
    public $timestamps = true;
    protected $fillable = array('name', 'password', 'phone', 'device_id', 'device_token', 'api_token', 'phone_verify', 'gender', 'status', 'image', 'state_id', 'city_id', 'info', 'address_id', 'activate_code', 'service_gender', 'ready_to_work', 'ready_to_notify');
    protected $visible = array('name', 'password', 'phone', 'device_id', 'device_token', 'api_token', 'phone_verify', 'gender', 'status', 'image', 'state_id', 'city_id', 'info', 'address_id', 'activate_code', 'service_gender', 'ready_to_work', 'ready_to_notify');

    public function services()
    {
        return $this->belongsToMany(Service::class,'barber_services');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'barber_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function readyToWork():bool
    {
        return $this->ready_to_work==1;
    }

}
