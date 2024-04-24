<?php

namespace Src\Features\Statics\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model 
{

    protected $table = 'privacy';
    public $timestamps = true;
    protected $fillable = array('text', 'for_who');
    protected $visible = array('text', 'for_who');

}