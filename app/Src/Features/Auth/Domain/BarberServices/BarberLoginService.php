<?php

namespace Src\Features\Auth\Domain\BarberServices;

use App\Src\Features\Auth\Core\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Core\Resources\BarberResource;
use Src\Features\Auth\Data\Repositories\BarberAuthRepository;

class BarberLoginService extends ServiceImp
{

    private  BarberAuthRepository $barberAuthRepository;

    /**
     * @param BarberAuthRepository $barberAuthRepository
     */
    public function __construct(BarberAuthRepository $barberAuthRepository)
    {
        $this->barberAuthRepository = $barberAuthRepository;
    }

    public function login(LoginRequest $request){

        $phone = $request->get('phone');
        $password = $request->get('password');

        $credentials = ['phone'=>$phone,'password'=>$password];
        if(Auth::gaurd('barber')->attempt($credentials)){
            $barber = $this->barberAuthRepository->checkExist('phone',$phone);
            if($barber){
                $data['id'] = $barber->id;
                $data['password'] = $barber->password;
                $updatedUser = $this->barberAuthRepository->update($data);
                if($updatedUser){
                    return new DataSuccess(
                        data:$updatedUser,
                        resourceData: new BarberResource($updatedUser),
                        message: 'تم تسجيل الدخول بنجاح'
                    );
                }else{
                    return new DataFailed(message: 'تاكد من رقم الهاتف واعد المحاولة');
                }
            }else{
                return new DataFailed(message: 'حدث خطآ ما اثناء تسجيل الدخول');
            }
        }else{
            $barber = $this->barberAuthRepository->checkExist('phone',$phone);
            if($barber){
                return new DataFailed(message: 'تاكد من كلمة المرور واعد المحاولة');
            }else{
                return new DataFailed(message: 'تاكد من رقم الهاتف واعد المحاولة');
            }
        }
    }


}
