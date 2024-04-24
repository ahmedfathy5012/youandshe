<?php

namespace Src\Features\BaseApp\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'adresses';
    public $timestamps = true;
    protected $fillable = array('address', 'lat', 'lon', 'name', 'address_type_id', 'status', 'user_id');
    protected $visible = array('address', 'lat', 'lon', 'name', 'address_type_id', 'status', 'user_id');

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function bookings()
    {
        return $this->hasMany('Booking');
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    public function barber()
    {
        return $this->hasOne('Barber');
    }

}
