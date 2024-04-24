<?php

namespace Src\Features\BaseApp\Domain\Services\DashBoard;

use Src\Base\Core\Storage\StorageFactory;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;

use Src\Features\BaseApp\Core\Requests\WebRequests\Service\AddServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\DeleteServiceWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Service\EditeServiceWebRequest;

use Src\Features\BaseApp\Core\Requests\WebRequests\Service\GoToEditeServiceWebRequest;
use Src\Features\BaseApp\Core\Resources\ServiceResource;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;



class DashServiceService extends ServiceImp
{
    private ServiceRepository $serviceRepository;
    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }


    public function index(){
        $services = $this->serviceRepository->index();
        if($services){
            return new DataSuccess(data:$services,resourceData: ServiceResource::collection($services),message: 'تم ارجاع الخدمات بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الخدمات بنجاح');
        }
    }

    public function create(AddServiceWebRequest $request){
        $storeImageHandler = StorageFactory::instance('server');
        $icon = null;
        if($request->hasFile('icon')){
            $icon = $storeImageHandler->storeFile($request->file('icon'));
        }
        $data = [
            "name" => $request->get('name'),
            "icon" => $icon??null,
            "price" => $request->get('price'),
            "duration" => $request->get('duration'),
            "gender" => $request->get('gender'),
        ];
        $service = $this->serviceRepository->create($data);
        if($service){
            $service->icon = $storeImageHandler->getFile($service->icon??'');
            return new DataSuccess(data:$service,message: 'تم اضافة الخدمة بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeServiceWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $service = $this->serviceRepository->find($request->get('id'));
        if($service){
            $service->icon = $storeImageHandler->getFile($service->icon??'');
            return new DataSuccess(data:$service,message: 'تم اضافة الخدمة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الخدمة');
        }
    }


    public function update(EditeServiceWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $icon = null;
        $oldService =  $this->serviceRepository->find($request->get('id'));
        if($request->hasFile('icon')){

            unlink("images/" . $oldService->icon);
            $icon = $storeImageHandler->storeFile($request->file('icon'));
        }
        $data=[
            'id'=> $request->get('id'),
            'name'=> $request->get('name'),
            "price" => $request->get('price'),
            "icon"=> $icon??$oldService->icon??null,
            "duration" => $request->get('duration'),
            "gender" => $request->get('gender'),
        ];
        $service = $this->serviceRepository->update($data);
        if($service){
            return new DataSuccess(data:$service,message: 'تم تعديل الخدمة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الخدمة');
        }
    }


    public function delete(DeleteServiceWebRequest $request)
    {
        $service = $this->serviceRepository->delete($request->get('id'));
        if($service){
            return new DataSuccess(data:$service,message: 'تم حذف الخدمة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الخدمة');
        }
    }

}
