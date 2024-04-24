<?php

namespace Src\Features\Auth\Domain\BarberServices;

use App\Src\Features\Auth\Core\Requests\BarberRegisterRequest;
use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Core\Resources\BarberResource;
use Src\Features\Auth\Data\Repositories\BarberAuthRepository;

class BarberRegisterService extends ServiceImp
{

    private  BarberAuthRepository $barberAuthRepository;

    /**
     * @param BarberAuthRepository $barberAuthRepository
     */
    public function __construct(BarberAuthRepository $barberAuthRepository)
    {
        $this->barberAuthRepository = $barberAuthRepository;
    }

    public function register(BarberRegisterRequest $request){
        if($request->has('password')){
            $request['password']  = Hash::make($request->get('password'));
            $request['api_token'] = bin2hex(openssl_random_pseudo_bytes(30));
        }
        $barber =  $this->barberAuthRepository->create($request->all());
        if($barber){
            return new DataSuccess(data:$barber,resourceData: new BarberResource($barber),message: 'تم انشاء الحساب بنجاح');
        }else{
            return new DataFailed(message: 'حصل خطآ ما اثناء انشاء الحساب');
        }
    }


}
