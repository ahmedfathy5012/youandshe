<?php

namespace Src\Features\Admin\Data\Repositories;

use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use Src\Base\Repositories\Repository;
use Src\Features\Admin\Data\Models\Admin;
use Src\Features\Auth\Data\Models\User;

class AdminRepository extends Repository
{

    public function __construct(Admin $admin)
    {
        $this->setModel($admin);
    }

}
