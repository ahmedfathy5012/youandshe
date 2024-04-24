<?php

namespace Src\Features\Auth\Domain\BarberServices;

use App\Src\Features\Auth\Core\Requests\ChangePasswordRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Core\Resources\BarberResource;
use Src\Features\Auth\Data\Repositories\BarberAuthRepository;

class BarberChangePasswordService extends ServiceImp
{

    private  BarberAuthRepository $barberAuthRepository;

    /**
     * @param BarberAuthRepository $barberAuthRepository
     */
    public function __construct(BarberAuthRepository $barberAuthRepository)
    {
        $this->barberAuthRepository = $barberAuthRepository;
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try{

            $barber = Auth::guard('barber')->user();

            if($barber){
                if (Hash::check($request->get('old_password'),$barber->password)) {
                    $data = [
                        "id" => $barber->id,
                        "password" => Hash::make($request->get('new_password')),
                    ];
                    $barber = $this->barberAuthRepository->update($data);
                    if($barber){
                        return new DataSuccess(data:$barber ,resourceData: new BarberResource($barber), message: 'تم تغيير كلمة المرور');
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
