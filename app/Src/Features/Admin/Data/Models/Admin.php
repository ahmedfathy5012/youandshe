<?php

namespace Src\Features\Admin\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;


//    protected $guard = 'admin';
    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'password');
    protected $visible = array('id','name', 'phone', 'password');
}
