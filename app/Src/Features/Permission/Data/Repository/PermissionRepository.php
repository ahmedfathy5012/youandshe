<?php

namespace App\Src\Features\Permission\Data\Repository;

use App\Src\Features\Permission\Data\Model\Permission;

use Src\Base\Repositories\Repository;

class PermissionRepository extends Repository
{

    public function __construct(Permission $role)
    {
        $this->setModel($role);
    }
}
