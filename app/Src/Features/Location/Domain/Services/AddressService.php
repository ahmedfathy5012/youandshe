<?php

namespace Src\Features\Location\Domain\Services;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataStatus;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Auth\Data\Repositories\AuthRepository;
use Src\Features\Location\Core\Requests\AddAddressRequest;
use Src\Features\Location\Core\Requests\DeleteAddressRequest;
use Src\Features\Location\Core\Requests\EditAddressRequest;
use Src\Features\Location\Core\Requests\SetAddressActiveRequest;
use Src\Features\Location\Core\Resources\AddressResource;
use Src\Features\Location\Data\Repositories\AddressRepository;
use Src\Features\Location\Data\Repositories\AddressTypeRepository;

class AddressService extends  ServiceImp
{

    private  AddressRepository $addressRepository;
    private  AddressTypeRepository $addressTypeRepository;
    /**
     * @param AddressRepository $addressRepository
     * @param AddressTypeRepository $addressTypeRepository
     */
    public function __construct(AddressRepository $addressRepository,AddressTypeRepository $addressTypeRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->addressTypeRepository = $addressTypeRepository;
    }

    private function checkAddressOwner()
    {

    }


    public function fetchMyAddresses():DataStatus
    {
        $user = Auth::user();
        try {
            $addresses = $user->addresses;
            if($addresses){
                return new DataSuccess(data:$addresses,resourceData: AddressResource::collection($addresses),message: 'تم ارجاع العناويين بنجاح');
            }else{
                return new DataFailed(message: 'حدث خطا اثناء ارجاع انواع العناويين');
            }
        }catch (\Exception $e){
            $this->handleException($e);
        }
    }

    public function addAddress(AddAddressRequest $request):DataStatus
    {
        $addressType = $this->addressTypeRepository->find($request->get('address_type_id'));
        if($addressType){
            $userId = Auth::id();
            $data = $request->all();
            $data['user_id'] = $userId ;
            $address = $this->addressRepository->create($data);
            if($address)
            {
                return new DataSuccess(data:$address,resourceData: new AddressResource($address),message: 'تم اضافة العنوان بنجاح');
            }else{
                return new DataFailed(message:'حدث خطآ ما اثناء حفظ العنوان توجة للدعم مباشرا');
            }
        }else{
            return new DataFailed(message:'نوع العنوان المدخل خطآ');
        }
    }

    public function editAddress(EditAddressRequest $request):DataStatus
    {

        $addressType = $this->addressTypeRepository->find($request->get('address_type_id'));
        if($addressType){
            $addressCheck = $this->addressRepository->find($request->get('id'));

            if($addressCheck){
                $userId = Auth::id();
                if(!($userId == $addressCheck->user_id)){
                    return new DataFailed(message:'ليس لديك الحق لحذف هذا العنوان');
                }
                $data = $request->all();
                $data['user_id'] = $userId ;
                $data['id'] = $request->get('id') ;
                $address = $this->addressRepository->update($data);
                if($address)
                {
                    return new DataSuccess(data:$address,resourceData: new AddressResource($address),message: 'تم تعديل العنوان بنجاح');
                }else{
                    return new DataFailed(message:'حدث خطآ ما اثناء تعديل العنوان توجة للدعم مباشرا');
                }
            }else{
                return new DataFailed(message:'العنوان المدخل خطآ');
            }
        }else{
            return new DataFailed(message:'نوع العنوان المدخل خطآ');
        }
    }

    public function deleteAddress(DeleteAddressRequest $request):DataStatus
    {

        $addressId = $request->get('id');
        $user = Auth::user();
        $address = $this->addressRepository->find($addressId);
        if($address){
            if($user->id == $address->user_id){
                $check = $this->addressRepository->delete($addressId);
                if($check)
                {
                    return new DataSuccess(data:$check,message: 'تم حذف العنوان بنجاح');
                }else{
                    return new DataFailed(message:'العنوان المدخل خطآ');
                }
            }else{
                return new DataFailed(message:'ليس لديك الحق لحذف هذا العنوان');
            }
        }else{
            return new DataFailed(message:'العنوان المدخل خطآ');
        }

    }


    public function setAddressActive(SetAddressActiveRequest $request)
    {
        $addressId = $request->get('id');
        $user = Auth::user();
        $address = $this->addressRepository->find($addressId);
        if($address){
            if(!($user->id == $address->user_id)){
                return new DataFailed(message:'ليس لديك الحق لحذف هذا العنوان');
            }
            foreach ($user->addresses as $selectAddress)
            {
                $data = [
                    "id" => $selectAddress->id,
                    "status" => 0,
                ];
                $this->addressRepository->update($data);
            }

            $data = [
                "id" => $addressId,
                "status" =>1,
            ];
            $check = $this->addressRepository->update($data);
            if($check)
            {
                return new DataSuccess(data:$check,message: 'تم تفعييل العنوان بنجاح');
            }else{
                return new DataFailed(message:'العنوان المدخل خطآ');
            }
        }else{
            return new DataFailed(message:'العنوان المدخل خطآ');
        }
    }

}
