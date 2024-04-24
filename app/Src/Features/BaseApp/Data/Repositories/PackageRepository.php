<?php

namespace Src\Features\BaseApp\Data\Repositories;

use Crm\Base\Requests\ApiRequest;
use Src\Base\Repositories\Repository;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Models\Service;

class PackageRepository extends Repository
{
    public function __construct(Package $package)
    {
        $this->setModel($package);
    }

}
