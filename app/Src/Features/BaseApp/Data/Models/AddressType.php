<?php

namespace Src\Features\BaseApp\Data\Models;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{

    protected $table = 'address_types';
    public $timestamps = true;
    protected $fillable = array('name', 'icon');
    protected $visible = array('id','name', 'icon');

    public function address()
    {
        return $this->hasMany('Address');
    }

}
