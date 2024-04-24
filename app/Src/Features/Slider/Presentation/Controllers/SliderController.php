<?php

namespace Src\Features\Slider\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Slider\Domain\Services\SliderService;

class SliderController extends  Controller
{

    private SliderService $sliderService;

    /**
     * @param SliderService $sliderService
     */
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }


    public function index()
    {
       return $this->sliderService->index()->response();
    }

}
