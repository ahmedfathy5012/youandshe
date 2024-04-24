<?php

namespace Src\Features\Location\Data\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{


    protected $table = 'states';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');

    public function cities()
    {
        return $this->hasMany('City');
    }

    public function users()
    {
        return $this->hasMany('User');
    }

    public function barbers()
    {
        return $this->hasMany('Barber');
    }

}
