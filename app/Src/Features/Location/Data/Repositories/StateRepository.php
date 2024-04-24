<?php

namespace Src\Features\Location\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Location\Data\Models\State;

class StateRepository extends Repository
{

    public function __construct(State $state)
    {
        $this->setModel($state);
    }
}
