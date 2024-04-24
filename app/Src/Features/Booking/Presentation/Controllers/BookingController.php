<?php

namespace Src\Features\Booking\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Booking\Core\Requests\BookBarberRequest;
use Src\Features\Booking\Core\Requests\BookStatusRequest;
use Src\Features\Booking\Core\Requests\CheckPriceRequest;
use Src\Features\Booking\Data\Models\BookingService;
use Src\Features\Booking\Domain\Services\BookService;
use Src\Features\Booking\Domain\Services\BookStatusService;
use Src\Features\Booking\Domain\Services\FetchBookingsService;

class BookingController extends Controller
{

    private BookService $bookService;
    private BookStatusService $bookStatusService;
    private FetchBookingsService $fetchBookingsService;

    /**
     * @param BookService $bookService
     * @param BookStatusService $bookStatusService
     * @param FetchBookingsService $fetchBookingsService
     */
    public function __construct(BookService $bookService, BookStatusService $bookStatusService, FetchBookingsService $fetchBookingsService)
    {
        $this->bookService = $bookService;
        $this->bookStatusService = $bookStatusService;
        $this->fetchBookingsService = $fetchBookingsService;
    }


    public function checkPrice(CheckPriceRequest $request,BookStatusService $bookStatusService)
     {
       return $this->bookService->checkPrice($request)->response();
     }


    public function bookBarber(BookBarberRequest $request)
    {
        return $this->bookService->bookBarber($request)->response();
    }

    public function acceptBooking(BookStatusRequest $request)
    {
       return $this->bookStatusService->acceptBooking($request)->response();
    }

    public function refuseBooking(BookStatusRequest $request)
    {
        return $this->bookStatusService->refuseBooking($request)->response();;
    }

    public function cancelBooking(BookStatusRequest $request)
    {
        return $this->bookStatusService->cancelBooking($request)->response();;
    }

    public function finishBooking(BookStatusRequest $request)
    {
        return $this->bookStatusService->finishBooking($request)->response();;
    }

    public function fetchNewBookings()
    {
        return $this->fetchBookingsService->fetchNewBookings()->response();;
    }

    public function fetchComingBookings()
    {
        return $this->fetchBookingsService->fetchComingBookings()->response();;
    }

    public function fetchFinishBookings()
    {
        return $this->fetchBookingsService->fetchFinishBookings()->response();;
    }

}
