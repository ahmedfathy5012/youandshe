<?php

namespace Src\Features\Auth\Domain\Services;

use App\Src\Features\Auth\Core\Requests\ChangePasswordRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Core\Resources\UserResource;
use Src\Features\Auth\Data\Repositories\AuthRepository;

class ChangePasswordService extends ServiceImp
{

    private  AuthRepository $authRepository;

    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try{
            $user = Auth::user();
            if($user){
                if (Hash::check($request->get('old_password'),$user->password)) {
                    $data = [
                        "id" => $user->id,
                        "password" => Hash::make($request->get('new_password')),
                    ];
                    $user = $this->authRepository->update($data);
                    if($user){
                        return new DataSuccess(data:$user ,resourceData: new UserResource($user), message: 'تم تغيير كلمة المرور');
                    }else{
                        return new DataFailed(message: 'حدث خطآ ما');
                    }
                } else{
                    return new DataFailed(message: 'كلمة المرور القديمة غير صحيحة');
                }
            }else{
                return new DataFailed(message: 'لا يوجد مستخدم');
            }
        }catch (\Exception $e){
            $this->handleException($e);
        }

    }
}
