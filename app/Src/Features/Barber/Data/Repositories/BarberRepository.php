<?php

namespace Src\Features\Barber\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Barber\Core\Requests\FetchAvailableBarbersRequest;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\BaseApp\Data\Models\Package;

class BarberRepository extends  Repository
{
    public function __construct(Barber $barber)
    {
        $this->setModel($barber);
    }

    public function fetchAvailableBarbers(FetchAvailableBarbersRequest $request)
    {
      $serviceIds = $request->has('service_ids')?$request->get('service_ids'):[];
       $cityId = $request->has('city_id')?$request->get('city_id'):null;
      $stateId =$request->has('state_id')? $request->get('state_id'):null;
      $packageId =$request->has('package_id')? $request->get('package_id'):null;

      if($packageId){
          $packageServices = Package::find($packageId)->services;
          foreach ($packageServices as $service)
          {
              $serviceIds[] = $service;
          }
      }

        return $this->getModel()->where('ready_to_work',1)
            ->when($cityId != null, function ($q) use ($cityId) {
            return $q->where('city_id', $cityId);
            })
            ->when($stateId != null, function ($q) use ($stateId) {
                return $q->where('state_id', $stateId);
            })
            ->whereHas('services',function($q) use($serviceIds) {
            if(!empty($serviceIds)){
                return $q->whereIn('service_id',$serviceIds);
            }
        })->get();
    }

}
