<?php

namespace Src\Features\Slider\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('image', 'barber_id', 'link');
    protected $visible = array('id','image', 'barber_id', 'link');

}
