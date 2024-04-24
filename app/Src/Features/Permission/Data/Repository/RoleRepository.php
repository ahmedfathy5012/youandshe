<?php

namespace App\Src\Features\Permission\Data\Repository;

use App\Src\Features\Permission\Data\Model\Role;
use Illuminate\Database\Eloquent\Model;
use Src\Base\Repositories\Repository;

class RoleRepository extends Repository
{

    public function __construct(Role $role)
    {
        $this->setModel($role);
    }
}
