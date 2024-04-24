<?php

namespace Src\Features\Location\Domain\Services;

use Src\Base\Response\DataFailed;
use Src\Base\Response\DataStatus;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Location\Data\Repositories\AddressTypeRepository;

class AddressTypeService extends  ServiceImp
{

    private  AddressTypeRepository $addressTypeRepository;

    /**
     * @param AddressTypeRepository $addressTypeRepository
     */
    public function __construct(AddressTypeRepository $addressTypeRepository)
    {
        $this->addressTypeRepository = $addressTypeRepository;
    }

    public function index():DataStatus
    {
        try {
            $addressTypes = $this->addressTypeRepository->index();
            if($addressTypes){
                return new DataSuccess(data:$addressTypes,message: 'تم ارجاع انوع العناويين');
            }else{
                return new DataFailed(message: 'حدث خطا اثناء ارجاع انواع العناويين');
            }
        }catch (\Exception $e){
            $this->handleException($e);
        }
    }


}
