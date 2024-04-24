<?php

namespace Src\Features\Location\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\BaseApp\Data\Models\Address;

class AddressRepository extends Repository
{

    public function __construct(Address $address)
    {
        $this->setModel($address);
    }
}
