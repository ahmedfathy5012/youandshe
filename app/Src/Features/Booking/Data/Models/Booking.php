<?php

namespace Src\Features\Booking\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\BaseApp\Data\Models\Address;
use Src\Features\BaseApp\Data\Models\Service;

class Booking extends Model
{

    protected $table = 'bookings';
    public $timestamps = true;
    protected $fillable = array('user_id', 'barber_id', 'date', 'time', 'price', 'discount', 'total', 'address_id', 'package_id', 'coupon_id', 'cancel_reason_id', 'cancel_reason_title','status');
    protected $visible = array('user_id', 'barber_id', 'date', 'time', 'price', 'discount', 'total', 'address_id', 'package_id', 'coupon_id', 'cancel_reason_id', 'cancel_reason_title','status');

    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class,'booking_services');
    }

    public function cancelReason()
    {
        return $this->belongsTo(CancelReason::class);
    }

}
