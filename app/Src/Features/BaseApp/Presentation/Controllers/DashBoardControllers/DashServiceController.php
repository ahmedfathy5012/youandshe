<?php

namespace Src\Features\BaseApp\Presentation\Controllers\DashBoardControllers;

use App\Http\Controllers\Controller;
use Src\Base\Response\DataSuccess;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\AddServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\DeleteServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\EditeServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\GoToEditeServiceWebRequest;
use Src\Features\BaseApp\Domain\Services\DashBoard\DashServiceService;


class DashServiceController extends Controller
{

    private DashServiceService $dashServiceService;
    /**
     * @param DashServiceService $dashServiceService
     */
    public function __construct(DashServiceService $dashServiceService)
    {
        $this->dashServiceService = $dashServiceService;
    }


    public function index()
   {
       $states = $this->dashServiceService->index();
       if($states instanceof DataSuccess){
           return view(view:'dashboard.service.index',data: ['services'=>$states->getData()]);
       }else{
           return view(view:'dashboard.service.index');
       }
   }

    public function create(AddServiceWebRequest $request)
    {

        $states = $this->dashServiceService->create($request);
        if($states instanceof DataSuccess){
            return $states->response(route:'services');
        }else{
            return $states->response();
        }
    }

    public function goToEditeBlade(GoToEditeServiceWebRequest $request)
    {

        $serviceDataState = $this->dashServiceService->find($request);
        if($serviceDataState instanceof DataSuccess){
              return view(view:'dashboard.service.add',data: ['service'=>$serviceDataState->getData(),]);
        }else{
            dd(false);
        }
    }

    public function goToAddBlade()
    {
        $dataState = $this->dashServiceService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.service.add');
        }else{
            dd(false);
        }
    }

    public function update(EditeServiceWebRequest $request)
    {

        $dataState = $this->dashServiceService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'services');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteServiceWebRequest $request)
    {
        $dataState = $this->dashServiceService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('services');
        }else{
            return $dataState->response();
        }
    }
}
