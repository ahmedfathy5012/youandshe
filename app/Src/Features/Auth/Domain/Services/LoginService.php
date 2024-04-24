<?php

namespace Src\Features\Auth\Domain\Services;

use App\Src\Features\Auth\Core\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Core\Resources\UserResource;
use Src\Features\Auth\Data\Repositories\AuthRepository;

class LoginService extends ServiceImp
{

    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request){

        $phone = $request->get('phone');
        $password = $request->get('password');

        $credentials = ['phone'=>$phone,'password'=>$password];
        if(Auth::attempt($credentials)){
            $user = $this->authRepository->checkExist('phone',$phone);
            if($user){
                $data['id'] = $user->id;
                $data['password'] = $user->password;
                $updatedUser = $this->authRepository->update($data);
                if($updatedUser){
                    return new DataSuccess(
                        data:$updatedUser,
                        resourceData: new UserResource($updatedUser),
                        message: 'تم تسجيل الدخول بنجاح'
                    );
                }else{
                    return new DataFailed(message: 'تاكد من رقم الهاتف واعد المحاولة');
                }
            }else{
                return new DataFailed(message: 'حدث خطآ ما اثناء تسجيل الدخول');
            }
        }else{
            $user = $this->authRepository->checkExist('phone',$phone);
            if($user){
                return new DataFailed(message: 'تاكد من كلمة المرور واعد المحاولة');
            }else{
                return new DataFailed(message: 'تاكد من رقم الهاتف واعد المحاولة');
            }
        }
    }


}
