<?php

namespace Src\Features\Permission\Presentaion\Controller;

use App\Http\Controllers\Controller;

use Src\Base\Response\DataSuccess;

use Src\Features\Permission\Core\Requests\WebRequests\Role\AddRoleWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Role\DeleteRoleWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Role\EditeRoleWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Role\GoToEditeRoleWebRequest;
use Src\Features\Permission\Domain\Service\RoleService;

class RoleController extends Controller
{

    private RoleService $roleService;

    /**
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }


    public function index()
    {
        $roles = $this->roleService->index();
        if($roles instanceof DataSuccess){
            return view(view:'dashboard.permission.role.index',data: ['roles'=>$roles->getData()]);
        }else{
            return view(view:'dashboard.permission.role.index');
        }
    }

    public function create(AddRoleWebRequest $request)
    {
        $roles = $this->roleService->create($request);
        if($roles instanceof DataSuccess){
            return $roles->response(route:'roles');
        }else{
            return $roles->response();
        }
    }


    public function goToAddBlade()
    {
        return view(view:'dashboard.permission.role.add');
    }

    public function goToEditeBlade(GoToEditeRoleWebRequest $request)
    {
        $dataState = $this->roleService->find($request);
        if($dataState instanceof DataSuccess){
            return view(view:'dashboard.permission.role.add',data: ['role'=>$dataState->getData()]);
        }else{
            dd(false);
        }
    }

    public function update(EditeRoleWebRequest $request)
    {

        $dataState = $this->roleService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'roles');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteRoleWebRequest $request)
    {
        $dataState = $this->roleService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('roles');
        }else{
            return $dataState->response();
        }
    }


}
