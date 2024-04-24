<?php

namespace Src\Features\Auth\Domain\BarberServices;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Core\Resources\BarberResource;
use Src\Features\Auth\Data\Repositories\BarberAuthRepository;


class BarberVerifyPhoneService extends ServiceImp
{

    private  BarberAuthRepository $barberAuthRepository;

    /**
     * @param BarberAuthRepository $barberAuthRepository
     */
    public function __construct(BarberAuthRepository $barberAuthRepository)
    {
        $this->barberAuthRepository = $barberAuthRepository;
    }

    public function verifyPhone()
    {
        try{
            $barber = Auth::guard('barber')->user();
            if($barber){
                    $data = [
                        "id" => $barber->id,
                        "password" => $barber->password,
                        "phone_verify"=>1,
                    ];
                    $barber = $this->barberAuthRepository->update($data);
                    if($barber){
                        return new DataSuccess(data:$barber ,resourceData: new BarberResource($barber), message: 'تم تفعيل الحساب');
                    }else{
                        return new DataFailed(message: 'حدث خطآ ما');
                    }

            }else{
                return new DataFailed(message: 'لا يوجد مستخدم');
            }
        }catch (\Exception $e){
            $this->handleException($e);
        }

    }
}
