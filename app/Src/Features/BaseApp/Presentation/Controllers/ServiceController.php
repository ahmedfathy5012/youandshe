<?php

namespace Src\Features\BaseApp\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\BaseApp\Domain\Services\ServiceService;

class ServiceController extends Controller
{

    private ServiceService $serviceService;

    /**
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }


    public function index()
    {
        return $this->serviceService->index()->response();
    }



}
