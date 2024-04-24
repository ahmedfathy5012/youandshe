<?php

namespace Src\Features\Permission\Presentaion\Controller;

use App\Http\Controllers\Controller;

use Src\Base\Response\DataSuccess;

use Src\Features\Permission\Core\Requests\WebRequests\Permission\AddPermissionWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\DeletePermissionWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\EditePermissionWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\GoToEditePermissionWebRequest;
use Src\Features\Permission\Domain\Service\PermissionService;
use Src\Features\Permission\Domain\Service\RoleService;

class PermissionController extends Controller
{

    private PermissionService $permissionService;

    /**
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }


    public function index()
    {
        $permissions = $this->permissionService->index();
        if($permissions instanceof DataSuccess){
            return view(view:'dashboard.permission.permission.index',data: ['permissions'=>$permissions->getData()]);
        }else{
            return view(view:'dashboard.permission.permission.index');
        }
    }

    public function create(AddPermissionWebRequest $request)
    {
        $permissions = $this->permissionService->create($request);
        if($permissions instanceof DataSuccess){
            return $permissions->response(route:'permissions');
        }else{
            return $permissions->response();
        }
    }


    public function goToAddBlade()
    {
        return view(view:'dashboard.permission.permission.add');
    }

    public function goToEditeBlade(GoToEditePermissionWebRequest $request)
    {
        $dataState = $this->permissionService->find($request);
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.permission.permission.add',data: ['permission'=>$dataState->getData()]);
        }else{
            dd(false);
        }
    }

    public function update(EditePermissionWebRequest $request)
    {

        $dataState = $this->permissionService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'permissions');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeletePermissionWebRequest $request)
    {
        $dataState = $this->permissionService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('permissions');
        }else{
            return $dataState->response();
        }
    }


}
