<?php

namespace Src\Features\BaseApp\Domain\Services;

use App\Src\Base\Core\Helpers\ExceptionHelper;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataStatus;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\BaseApp\Core\Resources\ServiceResource;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;


class ServiceService extends ServiceImp
{

    private ServiceRepository $serviceRepository;

    /**
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(int $paginate = 0) : DataStatus
    {
        try{
            $services = $this->serviceRepository->index($paginate);
            if($services){
                return new DataSuccess(
                    data:$services,
                    resourceData: ServiceResource::collection($services),
                    message: 'استرجاع كل الخدمات');
            }else{
                return new DataFailed(message:'حدث خطآ ما اثناء ايجاد الخدمات');
            }
        }catch (\Exception $e){
           $this->handleException1($e);
        }
    }
}
