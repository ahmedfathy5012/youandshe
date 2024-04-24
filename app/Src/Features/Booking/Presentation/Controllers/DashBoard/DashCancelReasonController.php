<?php

namespace Src\Features\Booking\Presentation\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Src\Features\Booking\Domain\Services\DashBoard\DashCancelReasonService;
use Src\Base\Response\DataSuccess;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\AddCancelReasonWebRequest;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\DeleteCancelReasonWebRequest;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\EditeCancelReasonWebRequest;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\GoToEditeCancelReasonWebRequest;


class DashCancelReasonController extends Controller
{

    private DashCancelReasonService $dashCancelReasonService;

    /**
     * @param DashCancelReasonService $dashCancelReasonService
     */
    public function __construct(DashCancelReasonService $dashCancelReasonService)
    {
        $this->dashCancelReasonService = $dashCancelReasonService;
    }


    public function index()
   {
       $dataState = $this->dashCancelReasonService->index();
       if($dataState instanceof DataSuccess){
           return view(view:'dashboard.cancelReason.index',data: ['cancel_reasons'=>$dataState->getData()]);
       }else{
           return view(view:'dashboard.cancelReason.index');
       }
   }

    public function create(AddCancelReasonWebRequest $request)
    {

        $dataState = $this->dashCancelReasonService->create($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'cancel_reasons');
        }else{
            return $dataState->response();
        }
    }

    public function goToEditeBlade(GoToEditeCancelReasonWebRequest $request)
    {

        $dataState = $this->dashCancelReasonService->find($request);
        if($dataState instanceof DataSuccess){
              return view(view:'dashboard.cancelReason.add',data: ['cancel_reason'=>$dataState->getData(),]);
        }else{
            dd(false);
        }
    }

    public function goToAddBlade()
    {
        $dataState = $this->dashCancelReasonService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.cancelReason.add');
        }else{
            dd(false);
        }
    }

    public function update(EditeCancelReasonWebRequest $request)
    {

        $dataState = $this->dashCancelReasonService->update($request);
        if($dataState instanceof DataSuccess){

            return $dataState->response(route:'cancel_reasons');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteCancelReasonWebRequest $request)
    {
        $dataState = $this->dashCancelReasonService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('cancel_reasons');
        }else{
            return $dataState->response();
        }
    }
}
