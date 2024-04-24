<?php

namespace Src\Features\BaseApp\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\BaseApp\Data\Models\Service;

class ServiceRepository extends Repository
{
    public function __construct(Service $service)
    {
        $this->setModel($service);
    }
}
