<?php

namespace Src\Features\Booking\Domain\Services\DashBoard;


use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;

use Src\Features\Booking\Data\Repositories\BookingRepository;




class DashBookingService extends ServiceImp
{
    private  BookingRepository $bookingRepository;

    /**
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }


    public function index(){
        $users = $this->bookingRepository->index();
        if($users){
            return new DataSuccess(data:$users,message: 'تم ارجاع الحجوزات بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الحجوزات بنجاح');
        }
    }

}
