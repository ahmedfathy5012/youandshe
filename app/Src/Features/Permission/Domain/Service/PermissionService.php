<?php

namespace Src\Features\Permission\Domain\Service;

use App\Src\Features\Permission\Data\Repository\PermissionRepository;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\AddPermissionWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\DeletePermissionWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\EditePermissionWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Permission\GoToEditePermissionWebRequest;


class PermissionService extends ServiceImp
{

    private PermissionRepository $permissionRepository;

    /**
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(){
        $permissions = $this->permissionRepository->index();
        if($permissions){
            return new DataSuccess(data:$permissions,message: 'تم ارجاع الادوار بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الادوار بنجاح');
        }
    }

    public function create(AddPermissionWebRequest $request){

        $permission = $this->permissionRepository->create($request->all());
        if($permission){
            return new DataSuccess(data:$permission,message: 'تم اضافة الدور بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditePermissionWebRequest $request)
    {
        $permission = $this->permissionRepository->find($request->get('id'));
        if($permission){
            return new DataSuccess(data:$permission,message: 'تم اضافة الدور بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الدور');
        }
    }


    public function update(EditePermissionWebRequest $request)
    {

        $permission = $this->permissionRepository->update($request->all());
        if($permission){
            return new DataSuccess(data:$permission,message: 'تم تعديل الدور بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الدور');
        }
    }


    public function delete(DeletePermissionWebRequest $request)
    {
        $permission = $this->permissionRepository->delete($request->get('id'));
        if($permission){
            return new DataSuccess(data:$permission,message: 'تم حذف الدور بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الدور');
        }
    }


}
