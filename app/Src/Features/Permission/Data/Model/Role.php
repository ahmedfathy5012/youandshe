<?php

namespace App\Src\Features\Permission\Data\Model;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{

    public $timestamps = true;
    protected $fillable = ['name','display_name','description'];
}
