<?php

namespace App\Src\Features\Booking\Domain\Services\DashBoard;

use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;

use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\AddCancelReasonWebRequest;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\DeleteCancelReasonWebRequest;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\EditeCancelReasonWebRequest;
use Src\Features\Booking\Core\Requests\WebRequests\CancelReason\GoToEditeCancelReasonWebRequest;
use Src\Features\Booking\Data\Repositories\CancelReasonRepository;


class DashCancelReasonService extends ServiceImp
{
    private CancelReasonRepository $cancelReasonRepository;
    /**
     * @param CancelReasonRepository $cancelReasonRepository
     */
    public function __construct(CancelReasonRepository $cancelReasonRepository)
    {
        $this->cancelReasonRepository = $cancelReasonRepository;
    }


    public function index(){
        $services = $this->cancelReasonRepository->index();
        if($services){
            return new DataSuccess(data:$services,message: 'تم ارجاع الاسباب بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الاسباب بنجاح');
        }
    }

    public function create(AddCancelReasonWebRequest $request){
        $data = [
            "title" => $request->get('title'),
        ];
        $service = $this->cancelReasonRepository->create($data);
        if($service){
            return new DataSuccess(data:$service,message: 'تم اضافة السبب بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeCancelReasonWebRequest $request)
    {
        $service = $this->cancelReasonRepository->find($request->get('id'));
        if($service){
            return new DataSuccess(data:$service,message: 'تم اضافة السبب بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع السبب');
        }
    }


    public function update(EditeCancelReasonWebRequest $request)
    {
        $data=[
            'id'=> $request->get('id'),
            'title'=> $request->get('title'),
        ];
        $service = $this->cancelReasonRepository->update($data);
        if($service){
            return new DataSuccess(data:$service,message: 'تم تعديل السبب بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع السبب');
        }
    }


    public function delete(DeleteCancelReasonWebRequest $request)
    {
        $service = $this->cancelReasonRepository->delete($request->get('id'));
        if($service){
            return new DataSuccess(data:$service,message: 'تم حذف السبب بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف السبب');
        }
    }

}
