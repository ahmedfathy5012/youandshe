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
use Src\Features\BaseApp\Data\Repositories\PackageRepository;
use Src\Features\BaseApp\Data\Repositories\PackageServicesRepository;


class DashPackageService extends ServiceImp
{
    private PackageRepository $packageRepository;
    private PackageServicesRepository $packageServicesRepository;

    /**
     * @param PackageRepository $packageRepository
     * @param PackageServicesRepository $packageServicesRepository
     */
    public function __construct(PackageRepository $packageRepository, PackageServicesRepository $packageServicesRepository)
    {
        $this->packageRepository = $packageRepository;
        $this->packageServicesRepository = $packageServicesRepository;
    }


    public function index(){
        $packages = $this->packageRepository->index();
        if($packages){
            return new DataSuccess(data:$packages,message: 'تم ارجاع الباقات بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الباقات بنجاح');
        }
    }

    public function create(AddPackageWebRequest $request){

        $storeImageHandler = StorageFactory::instance('server');
        $icon = null;
        if($request->hasFile('icon')){
            $icon = $storeImageHandler->storeFile($request->file('icon'));
        }
        $data = [
            "name" => $request->get('name'),
            "icon" => $icon??null,
            "price" => $request->get('price'),
        ];
        $package = $this->packageRepository->create($data);
        if($package){
            $package->icon = $storeImageHandler->getFile($package->icon??'');
            $services = $request->get('services');
//            foreach ($services as $serviceId){
//                $relationState = $this->packageServicesRepository->create([
//                    'service_id'=>$serviceId,
//                    'package_id'=>$package->id
//            ]);
//            }
            $relationState1 = $this->packageServicesRepository->create([
                'service_id'=>$services[0],
                'package_id'=>$package->id,]);
            $relationState2 = $this->packageServicesRepository->create([
                'service_id'=>$services[1],
                'package_id'=>$package->id,]);
            return new DataSuccess(data:$package,message: 'تم اضافة الباقة بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditePackageWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $package = $this->packageRepository->find($request->get('id'));
        if($package){
            $package->icon = $storeImageHandler->getFile($package->icon??'');
            return new DataSuccess(data:$package,message: 'تم اضافة الباقة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الباقة');
        }
    }


    public function update(EditePackageWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $icon = null;
        $oldPackage =  $this->packageRepository->find($request->get('id'));
        if($request->hasFile('icon')){
            unlink("images/" . $oldPackage->icon);
            $icon = $storeImageHandler->storeFile($request->file('icon'));
        }
        $data=[
            'id'=> $request->get('id'),
            'name'=> $request->get('name'),
            "price" => $request->get('price'),
            "icon"=> $icon??$oldPackage->icon??null,
        ];
        $package = $this->packageRepository->update($data);
        if($package){
            return new DataSuccess(data:$package,message: 'تم تعديل الباقة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الباقة');
        }
    }


    public function delete(DeletePackageWebRequest $request)
    {
        $package = $this->packageRepository->delete($request->get('id'));
        if($package){
            return new DataSuccess(data:$package,message: 'تم حذف الباقة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الباقة');
        }
    }

}
