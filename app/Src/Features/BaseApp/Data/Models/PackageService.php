<?php

namespace Src\Features\BaseApp\Data\Models;

use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{

    protected $table = 'package_services';
    public $timestamps = true;
    protected $fillable = array('package_id', 'service_id');
    protected $visible = array('package_id', 'service_id');



}
