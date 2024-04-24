<?php

namespace Src\Features\Admin\Presentation\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminDeleteWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminEditeWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminLoginWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminRegisterWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\GoToEditeAdminWebRequest;
use App\Src\Features\Auth\Core\Requests\LoginRequest;
use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Src\Base\Response\DataSuccess;
use Src\Features\Admin\Domain\Services\DashBoard\DashAdminService;
use Src\Features\Location\Core\Requests\DashBoard\DeleteStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\EditeStateWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\GoToEditeStateWebRequest;


class DashAdminController extends Controller
{

  private DashAdminService $dashAdminService;

    /**
     * @param DashAdminService $dashAdminService
     */
    public function __construct(DashAdminService $dashAdminService)
    {
        $this->dashAdminService = $dashAdminService;
    }


    public  function index()
    {
        $dataState = $this->dashAdminService->index();
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.admin.index',data: ['admins'=>$dataState->getData()]);
        }else{
            dd('an error eccur');
//            return view(view:'dashboard.user.index');
        }
    }


    public  function goToLoginBlade()
    {
        return view(view:'dashboard.admin.login');
    }



    public function login(AdminLoginWebRequest $request){
        $dataState = $this->dashAdminService->login($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route: 'states');
        }else{
            return $dataState->response();
        }
    }



    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }

    public  function goToAddBlade()
    {
        return view(view:'dashboard.admin.add');
    }

    public function create(AdminRegisterWebRequest $request){
        $dataState = $this->dashAdminService->register($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'admins');
        }else{
            return $dataState->response();
        }
    }


    public function goToEditeBlade(GoToEditeAdminWebRequest $request)
    {
        $dataState = $this->dashAdminService->find($request);
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.admin.add',data: ['admin'=>$dataState->getData()]);
        }else{
            dd(false);
        }
    }

    public function update(AdminEditeWebRequest $request)
    {

        $dataState = $this->dashAdminService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'admins');
        }else{
            return $dataState->response();
        }
    }


    public function delete(AdminDeleteWebRequest $request)
    {
        $dataState = $this->dashAdminService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('admins');
        }else{
            return $dataState->response();
        }
    }




}
