<?php

namespace Src\Features\BaseApp\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Crm\Base\Requests\ApiRequest;
use Src\Features\BaseApp\Core\Requests\PackageServicesRequest;
use Src\Features\BaseApp\Domain\Services\PackageService;

class PackageController extends Controller
{
    private PackageService $packageService;

    /**
     * @param PackageService $packageService
     */
    public function __construct(PackageService $packageService)
    {
         $this->packageService = $packageService;
    }

    public function index()
    {
        return $this->packageService->index()->response();
    }


    public function fetchPackageServices(PackageServicesRequest $request)
    {
        return $this->packageService->fetchPackageServices($request->id)->response();
    }


}
