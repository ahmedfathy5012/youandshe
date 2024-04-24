<?php

namespace Src\Features\Barber\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Barber\Core\Requests\AddBarberReviewRequest;
use Src\Features\Barber\Core\Requests\FetchAvailableBarbersRequest;
use Src\Features\Barber\Core\Requests\FetchBarberReviewsRequest;
use Src\Features\Barber\Domain\Services\BarberServiceReview;
use Src\Features\Barber\Domain\Services\FetchAvailableBarbersService;

class BarberController extends Controller
{

    private BarberServiceReview $barberServiceReview;
    private FetchAvailableBarbersService $fetchAvailableBarbersService;

    /**
     * @param BarberServiceReview $barberServiceReview
     * @param FetchAvailableBarbersService $fetchAvailableBarbersService
     */
    public function __construct(BarberServiceReview $barberServiceReview,FetchAvailableBarbersService $fetchAvailableBarbersService)
    {
        $this->barberServiceReview = $barberServiceReview;
        $this->fetchAvailableBarbersService = $fetchAvailableBarbersService;
    }


    public  function fetchBarberReviews(FetchBarberReviewsRequest $request)
    {
        return $this->barberServiceReview->fetchBarberReviews($request->get('barber_id'))->response();
    }

    public  function addBarberReview(AddBarberReviewRequest $request)
    {
        return $this->barberServiceReview->addBarberReview($request)->response();
    }

    public  function fetchAvailableBarbers(FetchAvailableBarbersRequest $request)
    {
        return $this->fetchAvailableBarbersService->fetchAvailableBarbers($request)->response();
    }



}
