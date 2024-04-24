<?php

namespace Src\Features\Barber\Domain\Services;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Core\Requests\AddBarberReviewRequest;
use Src\Features\Barber\Core\Requests\FetchBarberReviewsRequest;
use Src\Features\Barber\Core\Resources\ReviewResource;
use Src\Features\Barber\Data\Repositories\BarberRepository;
use Src\Features\Barber\Data\Repositories\ReviewRepository;

class BarberServiceReview extends ServiceImp
{
   private BarberRepository $barberRepository;
   private ReviewRepository $reviewRepository;

    /**
     * @param BarberRepository $barberRepository
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(BarberRepository $barberRepository,ReviewRepository $reviewRepository)
    {
        $this->barberRepository = $barberRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function fetchBarberReviews($barberId,$paginate=0)
    {
        $barber = $this->barberRepository->find($barberId);
        if($barber){
            if($paginate>0){
                $reviews = $barber->reviews()->paginate($paginate);
            }else{
                $reviews = $barber->reviews;
            }
            if($reviews){
                return  new DataSuccess(data:$reviews,resourceData: ReviewResource::collection($reviews),message: 'تم احضار تقييمات والحلاق بنجاح');
            }else{
                return new DataFailed(message:'حدث خطآ ما اثناء ايجاد تقييمات الحلاق حاول في وقت لاحق');
            }
        }else{
            return new DataFailed(message:'لا يوجد لدينا هذا الحلاق');
        }
    }

    public function addBarberReview(AddBarberReviewRequest $request){
        $barber = $this->barberRepository->find($request->get('barber_id'));
        if(!$barber){
           return new DataFailed(message:'لا يوجد حلاق لدينا بهذة المعلومات');
        }
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $review = $this->reviewRepository->create($data);
        if($review){
            return new DataSuccess(data:$review,resourceData: new ReviewResource($review),message: 'تم تقييم الحلاق بنجاح');
        }else{
            return new DataFailed(message:'حدث خطآ ما اثناء تقييم الحلاث');
        }

    }
}
