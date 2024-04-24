<?php

namespace Src\Features\Barber\Data\Models;

use Illuminate\Database\Eloquent\Model;

class BarberService extends Model
{

    protected $table = 'barber_services';
    public $timestamps = true;
    protected $fillable = array('barber_id', 'service_id');
    protected $visible = array('barber_id', 'service_id');

}
