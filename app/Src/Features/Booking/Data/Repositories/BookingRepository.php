<?php

namespace Src\Features\Booking\Data\Repositories;

use Exception;
use Illuminate\Support\Facades\Auth;
use Src\Base\Repositories\Repository;
use Src\Features\Booking\Core\Requests\CheckPriceRequest;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Models\Service;
use Src\Features\Booking\Data\Models\Booking;
use Src\Features\Booking\Data\Models\Coupon;
use Src\Features\Booking\Data\Models\Price;

class BookingRepository extends Repository
{

    public function __construct(Booking $booking)
    {
        $this->setModel($booking);
    }

    public function checkBookPrice(CheckPriceRequest $request)
    {
        $serviceIds = $request->has('service_ids')?$request->get('service_ids'):[];
        $packageId =$request->has('package_id')? $request->get('package_id'):null;
        $coupon =$request->has('coupon')? $request->get('coupon'):null;
        if($packageId){
            $packageServices = Package::find($packageId)->services;
            foreach ($packageServices as $service)
            {
                $serviceIds[] = $service;
            }
        }
        $uniqueServiceIds = [];
        $servicePrices = 0;
        $discount = 0;
        $total=0;
        foreach ($serviceIds as $serviceId)
        {
            if (!in_array($serviceId, $uniqueServiceIds)) {
                $uniqueServiceIds[]=$serviceId;
                $fetchedService = Service::find($serviceId);
                if($fetchedService){
                    $servicePrices =   $servicePrices + $fetchedService->price;
                }
            }

        }
        $total = $servicePrices;
        if($coupon!=null)
        {
            $coupon = Coupon::where('coupon',$coupon)->first();
            if($coupon!=null)
            {
               if($coupon->is_percentage==1){
                   $discount = $servicePrices*($coupon->discount/100);
                   $total = $servicePrices - $discount;
               }else{
                   $discount = $coupon->discount;
                   $total = $servicePrices - $discount;
               }
            }
        }
//        dd($total);
        return new Price(price:strval($servicePrices),discount: strval($discount),total: strval($total));
    }


    /**
     * @return mixed
     */
    public function fetchUserBookingsByStatus($value,$paginate = 0) {
        $user = Auth::user();
        try{
            return $user->bookings()->where('status',$value)->get();
        }catch (Exception $e)
        {
            exceptionResponse(message:$e->getMessage());
        }
    }


    /**
     * @return mixed
     */
    public function fetchUserFinishBookings($paginate = 0) {
        $user = Auth::user();
        try{
             return $user->bookings()->where('status',config('constants.bookingStatus')['refusedFromBarber'])
                ->orWhere('status',config('constants.bookingStatus')['finished'])
                ->orWhere('status',config('constants.bookingStatus')['refusedAutomatic'])
                ->orWhere('status',config('constants.bookingStatus')['cancelByClient'])
                ->get();

        }catch (Exception $e)
        {
            exceptionResponse(message:$e->getMessage());
        }
    }



}
