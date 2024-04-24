<?php

namespace Src\Features\Location\Presentation\DashBoardControllers;

use App\Http\Controllers\Controller;
use Src\Base\Response\DataSuccess;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\GoToEditeAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\AddCityWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\DeleteCityWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\EditeCityWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\GoToEditeCityWebRequest;
use Src\Features\Location\Domain\DashboardServices\DashCityService;
use Src\Features\Location\Domain\DashboardServices\DashStateService;


class DashCityController extends Controller
{

    private DashCityService $dashCityService;
    private DashStateService $dashStateService;

    /**
     * @param DashCityService $dashCityService
     * @param DashStateService $dashStateService
     */
    public function __construct(DashCityService $dashCityService, DashStateService $dashStateService)
    {
        $this->dashCityService = $dashCityService;
        $this->dashStateService = $dashStateService;
    }


    public function index()
   {
       $states = $this->dashCityService->index();
       if($states instanceof DataSuccess){
           return view(view:'dashboard.city.index',data: ['cities'=>$states->getData()]);
       }else{
           return view(view:'dashboard.city.index');
       }
   }

    public function create(AddCityWebRequest $request)
    {

        $states = $this->dashCityService->create($request);
        if($states instanceof DataSuccess){
            return $states->response(route:'cities');
        }else{
            return $states->response();
        }
    }

    public function goToEditeBlade(GoToEditeCityWebRequest $request)
    {
        $stateDataState = $this->dashStateService->index();
        $cityDataState = $this->dashCityService->find($request);
        if($cityDataState instanceof DataSuccess){
              return view(view:'dashboard.city.add',data: [
                  'city'=>$cityDataState->getData(),
                  'states'=>$stateDataState->getData(),
                  ]);
        }else{
            dd(false);
        }
    }

    public function goToAddBlade()
    {
        $dataState = $this->dashStateService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.city.add',data: ['states'=>$dataState->getData()]);
        }else{
            dd(false);
        }
    }

    public function update(EditeCityWebRequest $request)
    {

        $dataState = $this->dashCityService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'cities');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteCityWebRequest $request)
    {
        $dataState = $this->dashCityService->delete($request);
        if($dataState instanceof DataSuccess){
//            return $dataState->redirect('cities');
            return $dataState->response('cities');
        }else{
            return $dataState->response();
        }
    }


}
