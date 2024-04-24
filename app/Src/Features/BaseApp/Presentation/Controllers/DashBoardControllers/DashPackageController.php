<?php

namespace Src\Features\BaseApp\Presentation\Controllers\DashBoardControllers;

use App\Http\Controllers\Controller;
use Src\Base\Response\DataSuccess;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\AddPackageWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\DeletePackageWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\EditePackageWebRequest;
use Src\Features\BaseApp\Core\Requests\WebRequests\Package\GoToEditePackageWebRequest;
use Src\Features\BaseApp\Domain\Services\DashBoard\DashPackageService;
use Src\Features\BaseApp\Domain\Services\DashBoard\DashServiceService;


class DashPackageController extends Controller
{

    private DashPackageService $dashPackageService;
    private DashServiceService $dashServiceService;

    /**
     * @param DashPackageService $dashPackageService
     * @param DashServiceService $dashServiceService
     */
    public function __construct(DashPackageService $dashPackageService, DashServiceService $dashServiceService)
    {
        $this->dashPackageService = $dashPackageService;
        $this->dashServiceService = $dashServiceService;
    }


    public function index()
   {
       $dataState = $this->dashPackageService->index();
       if($dataState instanceof DataSuccess){
           return view(view:'dashboard.package.index',data: ['packages'=>$dataState->getData()]);
       }else{
           return view(view:'dashboard.package.index');
       }
   }

    public function create(AddPackageWebRequest $request)
    {
        $dataState = $this->dashPackageService->create($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'packages');
        }else{
            return $dataState->response();
        }
    }

    public function goToEditeBlade(GoToEditePackageWebRequest $request)
    {
        $serviceDataState = $this->dashServiceService->index();
        $dataState = $this->dashPackageService->find($request);
//        dd(count($dataState->getData()->services));
//        print_r($dataState->getData()->services);
        if($dataState instanceof DataSuccess){
              return view(view:'dashboard.package.add',data: [
                  'package'=>$dataState->getData(),
                  'services'=>$serviceDataState->getData()
                  ]);
        }else{
            dd(false);
        }
    }

    public function goToAddBlade()
    {
        $serviceDataState = $this->dashServiceService->index();
        if($serviceDataState instanceof DataSuccess){
            return view(view:'dashboard.package.add',data:['services'=>$serviceDataState->getData()]);
        }else{
            dd(false);
        }
    }

    public function update(EditePackageWebRequest $request)
    {

        $dataState = $this->dashPackageService->update($request);
        if($dataState instanceof DataSuccess){

            return $dataState->response(route:'packages');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeletePackageWebRequest $request)
    {
        $dataState = $this->dashPackageService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('packages');
        }else{
            return $dataState->response();
        }
    }
}
