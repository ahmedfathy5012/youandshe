<?php

namespace Src\Features\Statics\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model 
{

    protected $table = 'usages';
    public $timestamps = true;
    protected $fillable = array('text', 'for_who');
    protected $visible = array('text', 'for_who');

}