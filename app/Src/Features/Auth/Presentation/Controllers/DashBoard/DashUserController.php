<?php

namespace Src\Features\Auth\Presentation\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Src\Base\Response\DataSuccess;
use Src\Features\Auth\Domain\Services\DashBoard\DashUserService;

class DashUserController extends Controller
{
   private DashUserService $dashUserService;

    /**
     * @param DashUserService $dashUserService
     */
    public function __construct(DashUserService $dashUserService)
    {
        $this->dashUserService = $dashUserService;
    }

    public  function index()
    {
        $dataState = $this->dashUserService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.user.index',data: ['users'=>$dataState->getData()]);
        }else{
            dd('an error eccur');
//            return view(view:'dashboard.user.index');
        }
    }

}
