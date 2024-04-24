<?php

namespace App\Src\Features\Permission\Data\Repository;

use App\Src\Features\Permission\Data\Model\Team;
use Src\Base\Repositories\Repository;

class TeamRepository extends Repository
{

    public function __construct(Team $role)
    {
        $this->setModel($role);
    }
}
