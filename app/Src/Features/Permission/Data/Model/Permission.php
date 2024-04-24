<?php

namespace App\Src\Features\Permission\Data\Model;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $timestamps = true;
    protected $fillable = ['name','display_name','description'];
}
