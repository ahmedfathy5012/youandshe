<?php

namespace Src\Features\Location\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Location\Domain\Services\AddressTypeService;

class AddressTypeController extends  Controller
{

    private AddressTypeService $addressTypeService;

    /**
     * @param AddressTypeService $addressTypeService
     */
    public function __construct(AddressTypeService $addressTypeService)
    {
        $this->addressTypeService = $addressTypeService;
    }


    public function index()
    {
       return $this->addressTypeService->index()->response();
    }

}
