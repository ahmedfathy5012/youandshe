<?php

namespace Src\Features\Location\Domain\DashboardServices;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Src\Base\Core\Storage\StorageFactory;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\AddAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\DeleteAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\EditeAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\GoToEditeAddressTypeWebRequest;
use Src\Features\Location\Data\Repositories\AddressTypeRepository;


class DashAddressTypeService extends  ServiceImp
{

    private  AddressTypeRepository $addressTypeRepository;

    /**
     * @param AddressTypeRepository $addressTypeRepository
     */
    public function __construct(AddressTypeRepository $addressTypeRepository)
    {
        $this->addressTypeRepository = $addressTypeRepository;
    }

    public function index(){
        $addressTypes = $this->addressTypeRepository->index();

        if($addressTypes){
            return new DataSuccess(data:$addressTypes,message: 'تم ارجاع انواع العناويين بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع انواع العناويين بنجاح');
        }
    }

    public function create(AddAddressTypeWebRequest $request){
        $storeImageHandler = StorageFactory::instance('server');
        $icon = null;
        if($request->hasFile('icon')){
            $icon = $storeImageHandler->storeFile($request->file('icon'));
        }
        $data = [
            "name" => $request->get('name'),
            "icon" => $icon??null,
        ];
        $addressType = $this->addressTypeRepository->create($data);
        if($addressType){
            $addressType->icon = $storeImageHandler->getFile($addressType->icon);
            return new DataSuccess(data:$addressType,message: 'تم اضافة العنوان بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeAddressTypeWebRequest $request)
    {
        $addressType = $this->addressTypeRepository->find($request->get('id'));
        if($addressType){
            return new DataSuccess(data:$addressType,message: 'تم اضافة العنوان بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع العنوان');
        }
    }


    public function update(EditeAddressTypeWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $icon = null;
        if($request->hasFile('icon')){
            $icon = $storeImageHandler->storeFile($request->file('icon'));
        }
        $data = [
            'id'=> $request->get('id'),
            "name" => $request->get('name'),
            "icon" => $icon??null,
        ];

        $addressType = $this->addressTypeRepository->update($data);
        if($addressType){
            $addressType->icon = $storeImageHandler->getFile($addressType->icon);
            return new DataSuccess(data:$addressType,message: 'تم تعديل العنوان بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع العنوان');
        }
    }


    public function delete(DeleteAddressTypeWebRequest $request)
    {
        $addressType = $this->addressTypeRepository->delete($request->get('id'));
        if($addressType){
            return new DataSuccess(data:$addressType,message: 'تم حذف العنوان بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف العنوان');
        }
    }
}
