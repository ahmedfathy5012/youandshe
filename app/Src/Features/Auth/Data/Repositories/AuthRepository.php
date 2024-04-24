<?php

namespace Src\Features\Auth\Data\Repositories;

use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use Src\Base\Repositories\Repository;
use Src\Features\Auth\Data\Models\User;

class AuthRepository extends Repository
{

    public function __construct(User $user)
    {
        $this->setModel($user);
    }

}
