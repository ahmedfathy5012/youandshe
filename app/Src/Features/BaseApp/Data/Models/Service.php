<?php

namespace Src\Features\BaseApp\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Base\Core\Storage\StorageFactory;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\Booking\Data\Models\Booking;

class Service extends Model
{



    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = array('name', 'icon', 'duration', 'status', 'price');
    protected $visible = array('id','name', 'icon', 'duration', 'status', 'price');

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class,'booking_services');
    }

    public function barbers()
    {
        return $this->belongsToMany(Barber::class , 'barber_services');
    }


    public function getIcon()
    {
        $storeImageHandler = StorageFactory::instance('server');
        $icon = $storeImageHandler->getFile(file:$this->icon??'');
        return  $icon;
    }
}
