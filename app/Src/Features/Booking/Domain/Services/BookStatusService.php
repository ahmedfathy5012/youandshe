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

class BookStatusService extends  ServiceImp
{
    private BookingRepository $bookingRepository;

    /**
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    private function changeBookingStatus($bookId, $status,$userId=0,$barberId=0)
    {

        $book = $this->bookingRepository->find($bookId);
        if ($book) {
            if($userId!=0){
                if($book->user_id != $userId){
                    throw exceptionResponse(message: 'ليس لديك الحق في التعديل علي هذا الحجز');
                }
            }else{
                if($barberId!=0){
                    if($book->barber_id != $barberId){
                        throw exceptionResponse(message: 'ليس لديك الحق في التعديل علي هذا الحجز');
                    }
                }
            }

            $data = [
                'id' => $bookId,
                'status' => $status,
            ];
            $updatedBook = $this->bookingRepository->update($data);
            if ($updatedBook) {
                return new DataSuccess(
                    data: $updatedBook,
                    resourceData: new BookingResource($updatedBook),
                    message: 'تم تغيير حالة الحجز بنجاح'
                );
            } else {
                throw exceptionResponse(message: 'حدث خطآ ما اثناء تغيير الحالة');
            }
        } else {
            throw exceptionResponse(message: 'لا يوجد حجز مطابق لدينا');
        }
    }

    public function acceptBooking(BookStatusRequest $request)
    {
        return $this->changeBookingStatus($request->get('booking_id'),config('constants.bookingStatus')['accept'],userId:Auth::id());
    }

    public function cancelBooking(BookStatusRequest $request)
    {
        return $this->changeBookingStatus($request->get('booking_id'),config('constants.bookingStatus')['cancelByClient'],userId:Auth::id());
    }

    public function refuseBooking(BookStatusRequest $request)
    {
        return $this->changeBookingStatus($request->get('booking_id'),config('constants.bookingStatus')['refusedFromBarber'],barberId:Auth::id());
    }


    public function finishBooking(BookStatusRequest $request)
    {
       return $this->changeBookingStatus($request->get('booking_id'),config('constants.bookingStatus')['finished'],barberId:Auth::id());
    }

}
