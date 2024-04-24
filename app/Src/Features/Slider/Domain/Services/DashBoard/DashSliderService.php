<?php

namespace Src\Features\Slider\Domain\Services\DashBoard;

use Src\Base\Core\Storage\StorageFactory;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;

use Src\Base\Service\ServiceImp;

use Src\Features\Slider\Core\Requests\WebRequests\Slider\AddSliderWebRequest;
use Src\Features\Slider\Core\Requests\WebRequests\Slider\DeleteSliderWebRequest;
use Src\Features\Slider\Core\Requests\WebRequests\Slider\EditeSliderWebRequest;
use Src\Features\Slider\Core\Requests\WebRequests\Slider\GoToEditeSliderWebRequest;
use Src\Features\Slider\Data\Repositories\SliderRepository;


class DashSliderService extends ServiceImp
{
    private SliderRepository $sliderRepository;
    /**
     * @param SliderRepository $sliderRepository
     */
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }


    public function index(){
        $sliders = $this->sliderRepository->index();
        if($sliders){
            return new DataSuccess(data:$sliders,message: 'تم ارجاع الاعلانات بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الاعلانات بنجاح');
        }
    }

    public function create(AddSliderWebRequest $request){
        $storeImageHandler = StorageFactory::instance('server');
        $image = null;
        if($request->hasFile('image')){
            $image = $storeImageHandler->storeFile($request->file('image'));
        }
        $data = [
            "image" => $image??null,
        ];
        $slider = $this->sliderRepository->create($data);
        if($slider){
            $slider->image = $storeImageHandler->getFile($slider->image??'');
            return new DataSuccess(data:$slider,message: 'تم اضافة الاعلان بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeSliderWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $slider = $this->sliderRepository->find($request->get('id'));
        if($slider){
            $slider->image = $storeImageHandler->getFile($slider->image??'');
            return new DataSuccess(data:$slider,message: 'تم اضافة الاعلان بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الاعلان');
        }
    }


    public function update(EditeSliderWebRequest $request)
    {
        $storeImageHandler = StorageFactory::instance('server');
        $image = null;
        $oldSlider =  $this->sliderRepository->find($request->get('id'));

        if($request->hasFile('image')){
            if($oldSlider->image != null){
                unlink("images/" . $oldSlider->icon);
            }
            $image = $storeImageHandler->storeFile($request->file('image'));
        }
        $data=[
            'id'=> $request->get('id'),
            'image'=> $image??$oldSlider->image??null,
        ];
        $slider = $this->sliderRepository->update($data);
        if($slider){
            return new DataSuccess(data:$slider,message: 'تم تعديل الاعلان بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الاعلان');
        }
    }


    public function delete(DeleteSliderWebRequest $request)
    {
        $slider = $this->sliderRepository->find($request->get('id'));
        if($slider->image !=null){
            unlink("images/" . $slider->image);
        }
        $state = $this->sliderRepository->delete($request->get('id'));
        if($state){
            return new DataSuccess(data:$state,message: 'تم حذف الاعلان بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الاعلان');
        }
    }

}
