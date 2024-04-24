<?php

namespace Src\Features\Slider\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Slider\Data\Models\Slider;

class SliderRepository extends  Repository
{

    public function __construct(Slider $slider)
    {
        $this->setModel($slider);
    }
}
