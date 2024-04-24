<?php

namespace Src\Features\Booking\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model 
{

    protected $table = 'coupons';
    public $timestamps = true;
    protected $fillable = array('coupon', 'start_date', 'end_date', 'discount', 'is_percentage');
    protected $visible = array('coupon', 'start_date', 'end_date', 'discount', 'is_percentage');

}