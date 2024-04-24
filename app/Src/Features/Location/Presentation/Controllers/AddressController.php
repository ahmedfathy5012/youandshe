<?php

namespace Src\Features\Location\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Location\Core\Requests\AddAddressRequest;
use Src\Features\Location\Core\Requests\DeleteAddressRequest;
use Src\Features\Location\Core\Requests\EditAddressRequest;
use Src\Features\Location\Core\Requests\SetAddressActiveRequest;
use Src\Features\Location\Domain\Services\AddressService;

class AddressController extends Controller
{
   private AddressService $addressService;

    /**
     * @param AddressService $addressService
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function fetchMyAddresses()
    {
        return $this->addressService->fetchMyAddresses()->response();
    }

    public function addAddress(AddAddressRequest $request)
    {
        return $this->addressService->addAddress($request)->response();
    }

    public function editAddress(EditAddressRequest $request)
    {
        return $this->addressService->editAddress($request)->response();
    }

    public function deleteAddress(DeleteAddressRequest $request)
    {
        return $this->addressService->deleteAddress($request)->response();
    }

    public function setAddressActive(SetAddressActiveRequest $request)
    {
        return $this->addressService->setAddressActive($request)->response();
    }
}
