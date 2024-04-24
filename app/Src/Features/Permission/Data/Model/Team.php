<?php

namespace App\Src\Features\Permission\Data\Model;

use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    public $timestamps = true;
    protected $guarded = [];
}
