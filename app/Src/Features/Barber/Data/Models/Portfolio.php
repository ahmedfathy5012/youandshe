<?php

namespace Src\Features\Barber\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model 
{

    protected $table = 'portfolios';
    public $timestamps = true;
    protected $fillable = array('image', 'status', 'barber_id');
    protected $visible = array('image', 'status', 'barber_id');

    public function barber()
    {
        return $this->belongsTo('Barber');
    }

}