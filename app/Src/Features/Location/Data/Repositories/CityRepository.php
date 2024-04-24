<?php

namespace Src\Features\Location\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Location\Data\Models\City;

class CityRepository extends Repository
{
    public function __construct(City $city)
    {
        $this->setModel($city);
    }
}
