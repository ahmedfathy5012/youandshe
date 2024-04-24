<?php

namespace Src\Features\Auth\Domain\Services;

use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Core\Resources\UserResource;
use Src\Features\Auth\Data\Repositories\AuthRepository;

class AuthService extends ServiceImp
{

    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request){
        if($request->has('password')){
            $request['password']  = Hash::make($request->get('password'));
            $request['api_token'] = bin2hex(openssl_random_pseudo_bytes(30));
        }
        $user =  $this->authRepository->create($request->all());
        if($user){
            return new DataSuccess(data:$user,resourceData: new UserResource($user),message: 'تم انشاء الحساب بنجاح');
        }else{
            return new DataFailed(message: 'حصل خطآ ما اثناء انشاء الحساب');
        }
    }


}
