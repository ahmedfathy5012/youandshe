<?php

namespace Src\Features\Booking\Domain\Services;

use Illuminate\Support\Facades\Auth;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Barber\Data\Repositories\BarberRepository;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Models\Service;
use Src\Features\BaseApp\Data\Repositories\PackageRepository;
use Src\Features\BaseApp\Data\Repositories\ServiceRepository;
use Src\Features\Booking\Core\Requests\BookBarberRequest;
use Src\Features\Booking\Core\Requests\CheckPriceRequest;
use Src\Features\Booking\Core\Resources\BookingResource;
use Src\Features\Booking\Core\Resources\PriceResource;
use Src\Features\Booking\Data\Models\Coupon;
use Src\Features\Booking\Data\Models\Price;
use Src\Features\Booking\Data\Repositories\BookingRepository;
use Src\Features\Booking\Data\Repositories\BookingServiceRepository;
use Src\Features\Booking\Data\Repositories\CouponRepository;
use Src\Features\Location\Data\Repositories\AddressRepository;

class BookService extends  ServiceImp
{

    private BookingRepository $bookingRepository;
    private ServiceRepository $serviceRepository;
    private PackageRepository $packageRepository;
    private CouponRepository $couponRepository;
    private AddressRepository $addressRepository;
    private BarberRepository $barberRepository;
    private BookingServiceRepository $bookingServiceRepository;

    /**
     * @param BookingRepository $bookingRepository
     * @param ServiceRepository $serviceRepository
     * @param PackageRepository $packageRepository
     * @param CouponRepository $couponRepository
     * @param AddressRepository $addressRepository
     * @param BarberRepository $barberRepository
     * @param BookingServiceRepository $bookingServiceRepository
     */
    public function __construct(BookingRepository $bookingRepository, ServiceRepository $serviceRepository, PackageRepository $packageRepository, CouponRepository $couponRepository, AddressRepository $addressRepository, BarberRepository $barberRepository, BookingServiceRepository $bookingServiceRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->serviceRepository = $serviceRepository;
        $this->packageRepository = $packageRepository;
        $this->couponRepository = $couponRepository;
        $this->addressRepository = $addressRepository;
        $this->barberRepository = $barberRepository;
        $this->bookingServiceRepository = $bookingServiceRepository;
    }






    public  function checkPrice(CheckPriceRequest $request)
    {

        $serviceIds = $request->has('service_ids')?$request->get('service_ids')??[]:[];
        $packageId = $request->has('package_id')?$request->get('package_id'):null;
        $couponText = $request->has('coupon')?$request->get('coupon')??null:null;
        $price = $this->checkPriceLocal($serviceIds,$packageId,$couponText);

        if($price)
        {
            if(!$price->isHasError())
            {
                return new DataSuccess(
                    data:$price,
                    resourceData: new PriceResource($price),
                    message: $price->getMessage()??'تم حساب التكلفة بنجاح'
                );
            }else{
                return new DataFailed(
                    message: $price->getMessage()??'حدث خطآ ما اصناء حساب التكلفة'
                );
            }
        }else{
            return new DataFailed(
                message: $price->getMessage()??'حدث خطآ ما اصناء حساب التكلفة'
            );
        }


    }

    public function bookBarber(BookBarberRequest $request)
    {
        $this->bookBarberValidation($request);

        $barberId =$request->get('barber_id');
        $addressId =$request->get('address_id');

//        if($addressId!=Auth::id()){
//            throw  exceptionResponse(message:'العنوان المدرج غير مدرج للعميل');
//        }

        $serviceIds = [];
        if($request->has('service_ids')){
            $serviceIds =  $request->get('service_ids');
            foreach ($serviceIds as $serviceId){
                $service = $this->serviceRepository->find($serviceId);
                if($service==null){
                    throw  exceptionResponse(message:'هناك بعض الخدمات المرسلة غير مسجلة لدينا');
                }
                if(!in_array($barberId,$service->barbers->pluck('id')->toArray())){
                    throw  exceptionResponse(message:'هناك بعض الخدمات المرسلة غير مدرجة لدي هذا الحلاق');
                }
            }
        }

        $packageId = null;
        if($request->has('package_id')){
            $packageId =  $request->get('package_id');
        }

        $coupon = null;
        if($request->has('coupon')){
            $coupon =  $request->get('coupon');
        }



        $price = $this->checkPriceLocal(
            $serviceIds,
            $packageId,
            $coupon
        );


        if($price->isHasError()){
            throw exceptionResponse(message:$price->getMessage()??'حدث خطآ ما اثناء حساب التكلفة');
        }




        $data = [
            'user_id' => Auth::id(),
            'barber_id' => intval($barberId),
            'address_id' => intval($addressId),
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'price'=> $price->getPrice(),
            'discount'=>$price->getDiscount(),
            'total'=>$price->getTotal(),
        ];

        if($request->has('package_id')){
            $data['package_id']=  intval($request->get('package_id'));
        }

        if($request->has('coupon')){
            $coupon = $this->couponRepository->checkExist('coupon',$request->get('coupon'));
            if($coupon){
                $data['coupon_id']=  intval($coupon->id);
            }
        }

        $booking = $this->bookingRepository->create($data);

        if($booking!=null){
            if(empty($serviceIds)){
                return new DataSuccess(
                    data : $booking,
                    resourceData: new BookingResource($booking),
                    message: 'تم حجز الموعد بنجاح'
                );
            }
        }else{
            throw exceptionResponse(message: 'حدث خطآ ما اثناء حجز الموعد');
        }


        if(!empty($serviceIds)){
            $counter = 0;
            foreach ($serviceIds as $serviceId){
                $serviceData = [];
                $serviceData['service_id'] = intval($serviceId);
                $serviceData['booking_id'] =  intval($booking->id);
                $service = $this->bookingServiceRepository->create($serviceData);
                if($service==null){
                    $counter = intval($serviceId);
                }
            }
            if($counter==0){
                return new DataSuccess(
                    data : $booking,
                    resourceData: new BookingResource($booking),
                    message: 'تم حجز الموعد بنجاح'
                );
            }else{
                throw  exceptionResponse(message: $counter.'حدث خطا ما اثناء حفظ الخدمة ');
            }
        }

    }


    private function checkPriceLocal($serviceIds=[],$packageId=null,$couponText=null) : ?Price
    {

        $uniqueServiceIds = [];
        $servicePrices = 0;
        $discount = 0;
        $total=0;
        $errorMessage = null;


        // package section
        if($packageId){
            $package = $this->packageRepository->find($packageId);
            if($package){
//                $packageServices = $package->services;
//                foreach ($packageServices as $service)
//                {
//                    $serviceIds[] = $service;
//                    if (!in_array($serviceId, $uniqueServiceIds)) {
//                        $uniqueServiceIds[]=$serviceId;
//                        $fetchedService = $this->serviceRepository->find($serviceId);
//                        if($fetchedService){
//                            $servicePrices =   $servicePrices + $fetchedService->price;
//                        }
//                    }
//                }
                $servicePrices =  $servicePrices + $package->price;
            }else{
                return  new Price($servicePrices,$discount,$total,message:$errorMessage??null,hasError: true);
            }

        }


        // services section
        foreach ($serviceIds as $serviceId)
        {
            if (!in_array($serviceId, $uniqueServiceIds)) {
                $uniqueServiceIds[]=$serviceId;
                $fetchedService = $this->serviceRepository->find($serviceId);
                if($fetchedService){
                    $servicePrices =   $servicePrices + $fetchedService->price;
                }
            }
        }

        $total = $servicePrices;
        // coupon section
        if($couponText!=null)
        {
            $coupon = $this->couponRepository->checkExist('coupon',$couponText);

            if($coupon!=null)
            {
                if($coupon->is_percentage==1){
                    $discount = $servicePrices*($coupon->discount/100);
                    $total = $servicePrices - $discount;
                }else{
                    $discount = $coupon->discount;
                    $total = $servicePrices - $discount;
                }
                $errorMessage ='تم تطبيق الخصم ينجاح';
            }else{
                $errorMessage ='لايوجد كود خصم مطابق';
            }

        }


        return  new Price($servicePrices,$discount,$total,message:$errorMessage??null,hasError: false);
    }

    private function bookBarberValidation(BookBarberRequest $request)
    {
        if($request->has('package_id')){
            if(!$this->packageRepository->checkExist('id',$request->get('package_id')))
            {
                throw exceptionResponse(message:'لا يجد نتائج مطابقة للباقة التي ادخلتها');
            }
        }
        if($request->has('address_id')){
            if(!$this->addressRepository->checkExist('id',$request->get('address_id')))
            {
                throw exceptionResponse(message: 'لا يجد نتائج مطابقة للعنوان الذي ادخلتة');
            }
        }
        if(!$this->barberRepository->checkExist('id',$request->get('barber_id')))
        {
            throw exceptionResponse(message: 'لا يجد نتائج مطابقة للحلاق الذي اختارتة');
        }
    }




}
