<?php

namespace Src\Features\Slider\Presentation\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Src\Base\Response\DataSuccess;

use Src\Features\Slider\Core\Requests\WebRequests\Slider\AddSliderWebRequest;
use Src\Features\Slider\Core\Requests\WebRequests\Slider\DeleteSliderWebRequest;
use Src\Features\Slider\Core\Requests\WebRequests\Slider\EditeSliderWebRequest;
use Src\Features\Slider\Core\Requests\WebRequests\Slider\GoToEditeSliderWebRequest;
use Src\Features\Slider\Domain\Services\DashBoard\DashSliderService;


class DashSliderController extends Controller
{

    private DashSliderService $dashSliderService;

    /**
     * @param DashSliderService $dashSliderService
     */
    public function __construct(DashSliderService $dashSliderService)
    {
        $this->dashSliderService = $dashSliderService;
    }


    public function index()
   {
       $dataState = $this->dashSliderService->index();
       if($dataState instanceof DataSuccess){
           return view(view:'dashboard.slider.index',data: ['sliders'=>$dataState->getData()]);
       }else{
           return view(view:'dashboard.slider.index');
       }
   }

    public function create(AddSliderWebRequest $request)
    {

        $dataState = $this->dashSliderService->create($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'sliders');
        }else{
            return $dataState->response();
        }
    }

    public function goToEditeBlade(GoToEditeSliderWebRequest $request)
    {

        $dataState = $this->dashSliderService->find($request);
        if($dataState instanceof DataSuccess){
              return view(view:'dashboard.slider.add',data: ['slider'=>$dataState->getData(),]);
        }else{
            dd(false);
        }
    }

    public function goToAddBlade()
    {
//        $dataState = $this->dashSliderService->index();
//        if($dataState instanceof DataSuccess){
//            return view(view:'dashboard.slider.add');
//        }else{
//            dd(false);
//        }
        return view(view:'dashboard.slider.add');
    }

    public function update(EditeSliderWebRequest $request)
    {

        $dataState = $this->dashSliderService->update($request);
        if($dataState instanceof DataSuccess){

            return $dataState->response(route:'sliders');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteSliderWebRequest $request)
    {
        $dataState = $this->dashSliderService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('sliders');
        }else{
            return $dataState->response();
        }
    }
}
