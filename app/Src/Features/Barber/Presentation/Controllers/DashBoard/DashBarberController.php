<?php

namespace Src\Features\Barber\Presentation\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Src\Base\Response\DataSuccess;
use Src\Features\Auth\Domain\Services\DashBoard\DashUserService;
use Src\Features\Barber\Domain\Services\DashBoard\DashBarberService;

class DashBarberController extends Controller
{
   private DashBarberService $dashBarberService;

    /**
     * @param DashBarberService $dashBarberService
     */
    public function __construct(DashBarberService $dashBarberService)
    {
        $this->dashBarberService = $dashBarberService;
    }


    public  function index()
    {
        $dataState = $this->dashBarberService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.barber.index',data: ['barbers'=>$dataState->getData()]);
        }else{
            dd('an error eccur');
//            return view(view:'dashboard.user.index');
        }
    }

}
