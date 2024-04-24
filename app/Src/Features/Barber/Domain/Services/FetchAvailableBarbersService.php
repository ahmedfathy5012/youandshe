<?php

namespace Src\Features\Barber\Domain\Services;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Core\Resources\UserResource;
use Src\Features\Barber\Core\Requests\AddBarberReviewRequest;
use Src\Features\Barber\Core\Requests\FetchAvailableBarbersRequest;
use Src\Features\Barber\Core\Requests\FetchBarberReviewsRequest;
use Src\Features\Barber\Core\Resources\BarberResource;
use Src\Features\Barber\Core\Resources\ReviewResource;
use Src\Features\Barber\Data\Repositories\BarberRepository;
use Src\Features\Barber\Data\Repositories\FetchAvailableBarbersRepository;
use Src\Features\Barber\Data\Repositories\ReviewRepository;

class FetchAvailableBarbersService extends ServiceImp
{
   private BarberRepository $barberRepository;
    /**
     * @param BarberRepository $barberRepository
     */
    public function __construct(BarberRepository $barberRepository)
    {
        $this->barberRepository = $barberRepository;
    }

    public function fetchAvailableBarbers(FetchAvailableBarbersRequest $request)
    {
        $barbers = $this->barberRepository->fetchAvailableBarbers($request);
        if($barbers){
            return  new DataSuccess(data:$barbers,resourceData:  BarberResource::collection($barbers),message: 'تم احضار الحلاقين المتاحيين');
//            if($paginate>0){
//                $reviews = $barber->reviews()->paginate($paginate);
//            }else{
//                $reviews = $barber->reviews;
//            }
//            if($reviews){
//                return  new DataSuccess(data:$reviews,resourceData: ReviewResource::collection($reviews),message: 'تم احضار تقييمات والحلاق بنجاح');
//            }else{
//                return new DataFailed(message:'حدث خطآ ما اثناء ايجاد تقييمات الحلاق حاول في وقت لاحق');
//            }
        }else{
            return new DataFailed(message:'لا يوجد لدينا هذا الحلاق');
        }
    }

}
