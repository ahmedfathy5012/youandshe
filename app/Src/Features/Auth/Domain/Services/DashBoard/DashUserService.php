<?php

namespace Src\Features\Auth\Domain\Services\DashBoard;

use Src\Base\Core\Storage\StorageFactory;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;

use Src\Features\Auth\Data\Repositories\AuthRepository;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\AddServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\DeleteServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\EditeServiceWebRequest;

use Src\Features\BaseApp\Core\Requests\WebRequests\Service\GoToEditeServiceWebRequest;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;



class DashUserService extends ServiceImp
{
    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function index(){
        $users = $this->authRepository->index();
        if($users){
            return new DataSuccess(data:$users,message: 'تم ارجاع العملاء بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع العملاء بنجاح');
        }
    }


}
