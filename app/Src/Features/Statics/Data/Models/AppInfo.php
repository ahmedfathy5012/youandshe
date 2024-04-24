<?php

namespace Src\Features\Statics\Data\Models;

use Illuminate\Database\Eloquent\Model;

class AppInfo extends Model 
{

    protected $table = 'app_info';
    public $timestamps = true;
    protected $fillable = array('face', 'insta', 'YouTube', 'twitter', 'email', 'phone', 'app_status');
    protected $visible = array('face', 'insta', 'YouTube', 'twitter', 'email', 'phone', 'app_status');

}