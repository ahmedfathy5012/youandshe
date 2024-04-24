<?php

namespace Src\Features\Auth\Domain\BarberServices;

use App\Src\Features\Auth\Core\Requests\CheckPhoneRequest;
use App\Src\Features\Auth\Core\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Core\Resources\BarberResource;
use Src\Features\Auth\Data\Repositories\BarberAuthRepository;


class BarberResetPasswordService extends ServiceImp
{

    private  BarberAuthRepository $barberAuthRepository;

    /**
     * @param BarberAuthRepository $barberAuthRepository
     */
    public function __construct(BarberAuthRepository $barberAuthRepository)
    {
        $this->barberAuthRepository = $barberAuthRepository;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $phone = $request->get('phone');
        $password = $request->get('password');
        $barber = null;
        try{
            $barber = $this->barberAuthRepository->checkExist('phone',$phone);
            if($barber){
                $data=[];
                $data['id'] = $barber->id;
                $data['password'] =Hash::make($password);
                $updatedUser =  $this->barberAuthRepository->update($data);
                if($updatedUser){
                    return new DataSuccess(data:$barber ,resourceData: new BarberResource($barber), message: 'تم تغيير كلمة المرور');
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
