<?php

namespace Src\Features\Auth\Domain\BarberServices;

use App\Src\Features\Auth\Core\Requests\CheckPhoneRequest;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Data\Repositories\BarberAuthRepository;


class BarberCheckPhoneService extends ServiceImp
{

    private  BarberAuthRepository $barberAuthRepository;

    /**
     * @param BarberAuthRepository $barberAuthRepository
     */
    public function __construct(BarberAuthRepository $barberAuthRepository)
    {
        $this->barberAuthRepository = $barberAuthRepository;
    }

    public function checkPhone(CheckPhoneRequest $request){
        $barberExist = $this->barberAuthRepository->checkExist('phone',$request->get('phone'));
        if($barberExist){
            return new DataSuccess(data:true , message: 'هذا الرقم موجود بالفعل');
        }else{
            return new DataSuccess(data:false , message: 'هذا الرقم غير موجود لدينا');
        }
    }
}
