<?php

namespace Src\Features\Booking\Presentation\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Src\Base\Response\DataSuccess;
use Src\Features\Booking\Domain\Services\DashBoard\DashBookingService;

class DashBookingController extends Controller
{
   private DashBookingService $dashBookingService;

    /**
     * @param DashBookingService $dashBookingService
     */
    public function __construct(DashBookingService $dashBookingService)
    {
        $this->dashBookingService = $dashBookingService;
    }

    public  function index()
    {
        $dataState = $this->dashBookingService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.booking.index',data: ['bookings'=>$dataState->getData()]);
        }else{
            dd('an error eccur');
//            return view(view:'dashboard.user.index');
        }
    }

}
