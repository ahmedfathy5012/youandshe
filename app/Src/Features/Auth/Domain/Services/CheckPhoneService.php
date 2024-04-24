<?php

namespace Src\Features\Auth\Domain\Services;

use App\Src\Features\Auth\Core\Requests\CheckPhoneRequest;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Data\Repositories\AuthRepository;


class CheckPhoneService extends ServiceImp
{

    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function checkPhone(CheckPhoneRequest $request){
        $userExist = $this->authRepository->checkExist('phone',$request->get('phone'));
        if($userExist){
            return new DataSuccess(data:true , message: 'هذا الرقم موجود بالفعل');
        }else{
            return new DataSuccess(data:false , message: 'هذا الرقم غير موجود لدينا');
        }
    }
}
