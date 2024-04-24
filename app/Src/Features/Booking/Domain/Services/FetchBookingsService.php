<?php

namespace Src\Features\Booking\Domain\Services;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Data\Repositories\BarberRepository;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Models\Service;
use Src\Features\BaseApp\Data\Repositories\PackageRepository;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;
use Src\Features\Booking\Core\Requests\BookBarberRequest;
use Src\Features\Booking\Core\Requests\BookStatusRequest;
use Src\Features\Booking\Core\Requests\CheckPriceRequest;
use Src\Features\Booking\Core\Resources\BookingResource;
use Src\Features\Booking\Core\Resources\PriceResource;
use Src\Features\Booking\Data\Models\Coupon;
use Src\Features\Booking\Data\Models\Price;
use Src\Features\Booking\Data\Repositories\BookingRepository;
use Src\Features\Booking\Data\Repositories\BookingServiceRepository;
use Src\Features\Booking\Data\Repositories\CouponRepository;
use Src\Features\Location\Data\Repositories\AddressRepository;

class FetchBookingsService extends  ServiceImp
{
    private BookingRepository $bookingRepository;

    /**
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }


    public function fetchNewBookings()
    {
        $bookings =  $this->bookingRepository->fetchUserBookingsByStatus(config('constants.bookingStatus')['new']);
        if($bookings){
            return new DataSuccess(
                data:$bookings,
                resourceData: BookingResource::collection($bookings),
                message: 'تم ارجاع الحجوزات الجديدة بنجاح'
            );
        }else{
            return new DataFailed(
                message:'حدث خطآ ما اثناء ارجاع الحجوزات الجديدة'
            );
        }
    }

    public function fetchComingBookings()
    {
        $bookings =  $this->bookingRepository->fetchUserBookingsByStatus(config('constants.bookingStatus')['accepted']);
        if($bookings){
            return new DataSuccess(
                data:$bookings,
                resourceData: BookingResource::collection($bookings),
                message: 'تم ارجاع الحجوزات الجديدة بنجاح'
            );
        }else{
            return new DataFailed(
                message:'حدث خطآ ما اثناء ارجاع الحجوزات الجديدة'
            );
        }
    }

    public function fetchFinishBookings()
    {
        $bookings =  $this->bookingRepository->fetchUserFinishBookings();
        if($bookings){
            return new DataSuccess(
                data:$bookings,
                resourceData: BookingResource::collection($bookings),
                message: 'تم ارجاع الحجوزات الجديدة بنجاح'
            );
        }else{
            return new DataFailed(
                message:'حدث خطآ ما اثناء ارجاع الحجوزات الجديدة'
            );
        }
    }

}
