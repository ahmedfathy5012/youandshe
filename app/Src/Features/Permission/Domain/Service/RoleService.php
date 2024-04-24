<?php

namespace Src\Features\Permission\Domain\Service;

use App\Src\Features\Permission\Data\Repository\RoleRepository;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Permission\Core\Requests\WebRequests\Role\AddRoleWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Role\DeleteRoleWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Role\EditeRoleWebRequest;
use Src\Features\Permission\Core\Requests\WebRequests\Role\GoToEditeRoleWebRequest;


class RoleService extends ServiceImp
{

    private RoleRepository $roleRepository;

    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(){
        $services = $this->roleRepository->index();
        if($services){
            return new DataSuccess(data:$services,message: 'تم ارجاع الادوار بنجاح');
        }else{
            return new DataFailed(message: 'تم ارجاع الادوار بنجاح');
        }
    }

    public function create(AddRoleWebRequest $request){

        $service = $this->roleRepository->create($request->all());
        if($service){
            return new DataSuccess(data:$service,message: 'تم اضافة الدور بنجاح');
        }else{
            return new DataFailed(message: '');
        }
    }

    public function find(GoToEditeRoleWebRequest $request)
    {
        $service = $this->roleRepository->find($request->get('id'));
        if($service){
            return new DataSuccess(data:$service,message: 'تم اضافة الدور بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الدور');
        }
    }


    public function update(EditeRoleWebRequest $request)
    {

        $service = $this->roleRepository->update($request->all());
        if($service){
            return new DataSuccess(data:$service,message: 'تم تعديل الدور بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الدور');
        }
    }


    public function delete(DeleteRoleWebRequest $request)
    {
        $service = $this->roleRepository->delete($request->get('id'));
        if($service){
            return new DataSuccess(data:$service,message: 'تم حذف الدور بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الدور');
        }
    }


}
