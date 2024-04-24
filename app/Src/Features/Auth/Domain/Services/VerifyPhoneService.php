<?php

namespace Src\Features\Auth\Domain\Services;


use App\Src\Features\Auth\Core\Requests\CheckPhoneRequest;
use App\Src\Features\Auth\Core\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Core\Resources\UserResource;
use Src\Features\Auth\Data\Repositories\AuthRepository;


class VerifyPhoneService extends ServiceImp
{

    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function verifyPhone()
    {
        try{
            $user = Auth::user();
            if($user){
                    $data = [
                        "id" => $user->id,
                        "password" => $user->password,
                        "phone_verify"=>1,
                    ];
                    $user = $this->authRepository->update($data);
                    if($user){
                        return new DataSuccess(data:$user ,resourceData: new UserResource($user), message: 'تم تفعيل الحساب');
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
