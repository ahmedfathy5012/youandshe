<?php

namespace Src\Features\Location\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\BaseApp\Data\Models\AddressType;

class AddressTypeRepository extends Repository
{
    private AddressType $addressType;

    /**
     * @param AddressType $addressType
     */
    public function __construct(AddressType $addressType)
    {
        $this->setModel($addressType);
    }



}
