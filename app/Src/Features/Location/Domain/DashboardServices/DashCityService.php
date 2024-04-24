<?php

namespace Src\Features\Location\Domain\DashboardServices;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Location\Core\Requests\DashBoard\City\AddCityWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\DeleteCityWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\EditeCityWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\City\GoToEditeCityWebRequest;
use Src\Features\Location\Data\Repositories\CityRepository;



class DashCityService extends  ServiceImp
{

    private  CityRepository $cityRepository;

    /**
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index(){
        $cities = $this->cityRepository->index();
        if($cities){
            return new DataSuccess(data:$cities,message: 'تم ارجاع المدن بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع المدن بنجاح');
        }
    }

    public function create(AddCityWebRequest $request){
        $data = [
            "title" => $request->get('title'),
            "state_id" => $request->get('state_id'),
        ];
        $city = $this->cityRepository->create($data);
        if($city){
            return new DataSuccess(data:$city,message: 'تم اضافة المدن بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeCityWebRequest $request)
    {
        $city = $this->cityRepository->find($request->get('id'));
        if($city){
            return new DataSuccess(data:$city,message: 'تم اضافة المدينة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع المدينة');
        }
    }


    public function update(EditeCityWebRequest $request)
    {
        $data=[
            'id'=> $request->get('id'),
            'title'=> $request->get('title'),
            "state_id" => $request->get('state_id'),
        ];
        $city = $this->cityRepository->update($data);
        if($city){
            return new DataSuccess(data:$city,message: 'تم تعديل المدينة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع المدينة');
        }
    }


    public function delete(DeleteCityWebRequest $request)
    {
        $city = $this->cityRepository->delete($request->get('id'));
        if($city){
            return new DataSuccess(data:$city,message: 'تم حذف المدينة بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف المدينة');
        }
    }

}
