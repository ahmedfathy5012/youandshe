<?php

namespace Src\Features\BaseApp\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Booking\Data\Models\Booking;

class Package extends Model
{

    protected $table = 'packages';
    public $timestamps = true;
    protected $fillable = array('name', 'price', 'icon');
    protected $visible = array('name', 'price', 'icon');

    public function services()
    {
        return $this->belongsToMany(Service::class,PackageService::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

}
