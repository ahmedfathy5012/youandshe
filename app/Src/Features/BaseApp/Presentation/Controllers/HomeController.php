<?php

namespace Src\Features\BaseApp\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Base\Response\DataStatus;
use Src\Base\Response\DataSuccess;
use Src\Features\BaseApp\Core\Resources\PackageResource;
use Src\Features\BaseApp\Core\Resources\ServiceResource;
use Src\Features\BaseApp\Domain\Services\PackageService;
use Src\Features\BaseApp\Domain\Services\ServiceService;
use Src\Features\Blog\Core\Resources\BlogResource;
use Src\Features\Blog\Domain\Services\BlogService;
use Src\Features\Slider\Domain\Services\SliderService;

class HomeController extends Controller
{
    private SliderService $sliderService;
    private ServiceService $serviceService;
    private PackageService $packageService;
    private BlogService $blogService;

    /**
     * @param SliderService $sliderService
     * @param ServiceService $serviceService
     * @param PackageService $packageService
     * @param BlogService $blogService
     */
    public function __construct(SliderService $sliderService, ServiceService $serviceService, PackageService $packageService, BlogService $blogService)
    {
        $this->sliderService = $sliderService;
        $this->serviceService = $serviceService;
        $this->packageService = $packageService;
        $this->blogService = $blogService;
    }


    public function fetchHome()
    {
        $sliderData = $this->sliderService->index();
        $serviceData = $this->serviceService->index(paginate: 16);
        $packageData = $this->packageService->index(paginate: 16);
        $blogData = $this->blogService->index(paginate: 8);

        $data = [
            "sliders"  => $sliderData->getData(),
            "services" => ServiceResource::collection($serviceData->getData()),
            "packages" => PackageResource::collection($packageData->getData()),
            "blog" => BlogResource::collection($blogData->getData()),
        ];

        $dataState =  new DataSuccess(
            data: $data,
            message: 'تم ارجاع الرئيسية بنجاح'
        );

        return $dataState->response();

    }



}
