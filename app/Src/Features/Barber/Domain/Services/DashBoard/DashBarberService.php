<?php

namespace Src\Features\Barber\Domain\Services\DashBoard;

use Src\Base\Core\Storage\StorageFactory;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;

use Src\Features\Auth\Data\Repositories\AuthRepository;
use Src\Features\Barber\Data\Repositories\BarberRepository;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\AddServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\DeleteServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\EditeServiceWebRequest;

use Src\Features\BaseApp\Core\Requests\WebRequests\Service\GoToEditeServiceWebRequest;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;



class DashBarberService extends ServiceImp
{
    private  BarberRepository $barberRepository;

    /**
     * @param BarberRepository $barberRepository
     */
    public function __construct(BarberRepository $barberRepository)
    {
        $this->barberRepository = $barberRepository;
    }



    public function index(){
        $barbers = $this->barberRepository->index();
        if($barbers){
            return new DataSuccess(data:$barbers,message: 'تم ارجاع الحلاقين بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الحلاقين بنجاح');
        }
    }


}
