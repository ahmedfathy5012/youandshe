<?php

namespace Src\Features\Booking\Data\Models;

use Illuminate\Database\Eloquent\Model;

class BookingService extends Model 
{

    protected $table = 'booking_services';
    public $timestamps = true;
    protected $fillable = array('booking_id', 'service_id');
    protected $visible = array('booking_id', 'service_id');

}