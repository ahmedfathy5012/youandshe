<?php

namespace Src\Features\Location\Domain\DashboardServices;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Location\Core\Requests\DashBoard\AddStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\DeleteStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\EditeStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\GoToEditeStateWebRequest;
use Src\Features\Location\Data\Repositories\StateRepository;


class DashStateService extends  ServiceImp
{

    private  StateRepository $stateRepository;

    /**
     * @param StateRepository $stateRepository
     */
    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function index(){
        $states = $this->stateRepository->index();

        if($states){
            return new DataSuccess(data:$states,message: 'تم ارجاع المحافظات بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع المحافظات بنجاح');
        }
    }

    public function create(AddStateWebRequest $request){
        $data = [
            "title" => $request->get('title'),
        ];
        $states = $this->stateRepository->create($data);
        if($states){
            return new DataSuccess(data:$states,message: 'تم اضافة المحافظة بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeStateWebRequest $request)
    {
        $state = $this->stateRepository->find($request->get('id'));
        if($state){
            return new DataSuccess(data:$state,message: 'تم اضافة المحافظة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع المحافظة');
        }
    }


    public function update(EditeStateWebRequest $request)
    {
        $data=[
            'id'=> $request->get('id'),
            'title'=> $request->get('title')
        ];
        $state = $this->stateRepository->update($data);
        if($state){
            return new DataSuccess(data:$state,message: 'تم تعديل المحافظة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع المحافظة');
        }
    }


    public function delete(DeleteStateWebRequest $request)
    {
        $state = $this->stateRepository->delete($request->get('id'));
        if($state){
            return new DataSuccess(data:$state,message: 'تم حذف المحافظة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف المحافظة');
        }
    }

}
