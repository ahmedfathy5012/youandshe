<?php

namespace Src\Features\Auth\Data\Repositories;

use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use Src\Base\Repositories\Repository;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Barber\Data\Models\Barber;

class BarberAuthRepository extends Repository
{

    public function __construct(Barber $barber)
    {
        $this->setModel($barber);
    }

}
