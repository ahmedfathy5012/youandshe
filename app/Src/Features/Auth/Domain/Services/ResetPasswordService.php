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


class ResetPasswordService extends ServiceImp
{

    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $phone = $request->get('phone');
        $password = $request->get('password');
        $user = null;
        try{
            $user = $this->authRepository->checkExist('phone',$phone);
            if($user){
                $data=[];
                $data['id'] = $user->id;
                $data['password'] =Hash::make($password);
                $updatedUser =  $this->authRepository->update($data);
                if($updatedUser){
                    return new DataSuccess(data:$user ,resourceData: new UserResource($user), message: 'تم تغيير كلمة المرور');
                }else{
                    return new DataFailed(message: 'حدث خطآ ما اثناء تغيير كلمة السر');
                }
            }else{
                return new DataFailed(message: 'هذا الرقم غير موجود لدينا');
            }
        }catch (\Exception $e){
            $this->handleException($e);
        }

    }
}
