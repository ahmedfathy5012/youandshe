<?php

namespace Src\Features\Slider\Domain\Services;

use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Slider\Data\Repositories\SliderRepository;

class SliderService extends ServiceImp
{
    private SliderRepository $sliderRepository;

    /**
     * @param SliderRepository $sliderRepository
     */
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function index(int $paginate = 0)
    {
        try {
            $sliders = $this->sliderRepository->index($paginate);
            if($sliders){
                return new DataSuccess(data:$sliders,message: 'تم ارجاع الاعلانات بنجاح');
            }else{
                return new DataFailed(message: 'حدث خطآ ما في ارجاع الاعلانات');
            }
        }catch (\Exception $e){
            return new DataFailed(message: $e->getMessage());
        }
    }


}
