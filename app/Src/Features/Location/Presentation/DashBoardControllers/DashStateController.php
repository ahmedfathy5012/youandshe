<?php

namespace Src\Features\Location\Presentation\DashBoardControllers;

use App\Http\Controllers\Controller;
use http\Message;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Src\Base\Response\DataSuccess;
use Src\Features\Location\Core\Requests\DashBoard\AddStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\DeleteStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\EditeStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\GoToEditeStateWebRequest;
use Src\Features\Location\Domain\DashboardServices\DashStateService;

class DashStateController extends Controller
{

    private DashStateService $dashStateService;

    /**
     * @param DashStateService $dashStateService
     */
    public function __construct(DashStateService $dashStateService)
    {
        $this->dashStateService = $dashStateService;
    }


    public function index()
   {
       $states = $this->dashStateService->index();
       if($states instanceof DataSuccess){
           return view(view:'dashboard.states.index',data: ['states'=>$states->getData()]);
       }else{
           return view(view:'dashboard.states.index');
       }
   }

    public function create(AddStateWebRequest $request)
    {
        $states = $this->dashStateService->create($request);
        if($states instanceof DataSuccess){
            return $states->response(route:'states');
        }else{
            return $states->response();
        }
    }

    public function goToEditeBlade(GoToEditeStateWebRequest $request)
    {
        $dataState = $this->dashStateService->find($request);
        if($dataState instanceof DataSuccess){
              return view(view:'dashboard.states.add',data: ['state'=>$dataState->getData()]);
        }else{
            dd(false);
        }
    }

    public function update(EditeStateWebRequest $request)
    {

        $dataState = $this->dashStateService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'states');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteStateWebRequest $request)
    {
        $dataState = $this->dashStateService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('states');
        }else{
            return $dataState->response();
        }
    }


}
