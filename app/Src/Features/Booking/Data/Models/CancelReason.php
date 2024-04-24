<?php

namespace Src\Features\Booking\Data\Models;

use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{

    protected $table = 'cancel_reasons';
    public $timestamps = true;
    protected $fillable = array('title');
    protected $visible = array('id','title');

    public function cancelBookings()
    {
        return $this->hasMany('Booking');
    }

}
