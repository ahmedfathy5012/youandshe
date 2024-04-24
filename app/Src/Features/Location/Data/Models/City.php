<?php

namespace Src\Features\Location\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Barber;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('title', 'state_id');
    protected $visible = array('title', 'state_id');

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function barbers()
    {
        return $this->hasMany(Barber::class);
    }

}
