<?php

namespace Src\Features\BaseApp\Domain\Services\DashBoard;

use Src\Base\Core\Storage\StorageFactory;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\AddPackageWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\DeletePackageWebRequest;

use Src\Features\BaseApp\Core\Requests\WebRequests\Package\EditePackageWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\GoToEditePackageWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\PackageService\DeletePackageServiceWebRequest;
use Src\Features\BaseApp\Data\Repositories\PackageRepository;
use Src\Features\BaseApp\Data\Repositories\PackageServicesRepository;


class DashPackageServicesService extends ServiceImp
{
    private PackageServicesRepository $packageServicesRepository;
    /**
     * @param PackageServicesRepository $packageServicesRepository
     */
    public function __construct(PackageServicesRepository $packageServicesRepository)
    {
        $this->packageServicesRepository = $packageServicesRepository;
    }


//    public function index(){
//        $relations = $this->packageServicesRepository->index();
//        if($relations){
//            return new DataSuccess(data:$relations,message: 'تم ارجاع الباقات بنجاح');
//        }else{
//            return new DataFailed(message: 'تم ارجاع الباقات بنجاح');
//        }
//    }

    public function create($data){
        $relation = $this->packageServicesRepository->create($data);
        if($relation){
            return new DataSuccess(data:$relation,message: 'تم اضافة العلاقة بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

//    public function find(GoToEditePackageWebRequest $request)
//    {
//        $relation = $this->packageServicesRepository->find($request->get('id'));
//        if($relation){
//            return new DataSuccess(data:$relation,message: 'تم اضافة الباقة بنجاح');
//        }else{
//            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الباقة');
//        }
//    }
//
//
//    public function update(EditePackageWebRequest $request)
//    {
//        $storeImageHandler = StorageFactory::instance('server');
//        $icon = null;
//        if($request->hasFile('icon')){
//            $icon = $storeImageHandler->storeFile($request->file('icon'));
//        }
//        $data=[
//            'id'=> $request->get('id'),
//            'name'=> $request->get('name'),
//            "price" => $request->get('price'),
//            "icon"=> $icon??null,
//        ];
//        $relation = $this->packageServicesRepository->update($data);
//        if($relation){
//            return new DataSuccess(data:$relation,message: 'تم تعديل الباقة بنجاح');
//        }else{
//            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الباقة');
//        }
//    }
//

    public function delete($data)
    {
        $relation = $this->packageServicesRepository->deleteRow(serviceId: $data['service_id'],packageId: $data['package_id']);
        if($relation){
            return new DataSuccess(data:$relation,message: 'تم حذف الباقة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الباقة');
        }
    }

}
