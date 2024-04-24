<?php

namespace Src\Features\BaseApp\Domain\Services;


use Src\Base\Response\DataFailed;
use Src\Base\Response\DataStatus;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\BaseApp\Core\Resources\PackageResource;
use Src\Features\BaseApp\Core\Resources\ServiceResource;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Repositories\PackageRepository;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;


class PackageService extends ServiceImp
{

    private PackageRepository $packageRepository;

    /**
     * @param PackageRepository $packageRepository
     */
    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index(int $paginate = 0) : DataStatus
    {
        try{
            $packages = $this->packageRepository->index($paginate);
            if($packages){
                return new DataSuccess(
                    data: $packages,
                    resourceData: PackageResource::collection($packages),
                    message: 'استرجاع كل الباقات');
            }else{
                return new DataFailed(message:'حدث خطآ ما اثناء ايجاد الباقات');
            }
        }catch (\Exception $e){
           $this->handleException($e);
        }
    }

    public function fetchPackageServices($id,int $paginate = 0) : DataStatus
    {
        try{
            $package = $this->packageRepository->find($id);
            if($package){
                return new DataSuccess(
                    data: $package->services,
                    resourceData: ServiceResource::collection($package->services),
                    message: 'استرجاع خدمات الباقة');
            }else{
                return new DataFailed(message:'لا توجد باقة مماثلة للمدخلات');
            }
        }catch (\Exception $e){
            $this->handleException($e);
        }
        return new DataFailed(message:'حدث خطآ ما اثناء استرجاع خدمات الباقات');
    }
}
