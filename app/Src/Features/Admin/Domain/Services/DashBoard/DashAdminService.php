<?php

namespace Src\Features\Admin\Domain\Services\DashBoard;

use App\Src\Features\Admin\Core\Requests\WebRequests\AdminDeleteWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminEditeWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminLoginWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\AdminRegisterWebRequest;
use App\Src\Features\Admin\Core\Requests\WebRequests\GoToEditeAdminWebRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Admin\Data\Repositories\AdminRepository;
use Src\Features\Auth\Core\Resources\UserResource;

class DashAdminService extends ServiceImp
{

    private AdminRepository $adminRepository;
    /**
     * @param AdminRepository $adminRepository
     */

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index(){
        $admins = $this->adminRepository->index();
        if($admins){
            return new DataSuccess(data:$admins,message: 'تم ارجاع المديرين بنجاح');
        }else{
            return new DataFailed(message: 'لم يتم ارجاع المديرين بنجاح');
        }
    }

    public function login(AdminLoginWebRequest $request){
        $phone = $request->get('phone');
        $password = $request->get('password');
        $credentials = ['phone'=>$phone,'password'=>$password];
        if(Auth::guard('admin')->attempt($credentials)){
            $admin = $this->adminRepository->checkExist('phone',$phone);
            if($admin){
                $data['id'] = $admin->id;
                $data['password'] = $admin->password;
                $updatedUser = $this->adminRepository->update($data);
                if($updatedUser){
                    return new DataSuccess(
                        data:$updatedUser,
                        resourceData: new UserResource($updatedUser),
                        message: 'تم تسجيل الدخول بنجاح'
                    );
                }else{
                    return new DataFailed(message: 'تاكد من رقم الهاتف واعد المحاولة');
                }
            }else{
                return new DataFailed(message: 'حدث خطآ ما اثناء تسجيل الدخول');
            }
        }else{
            return new DataFailed(message: 'تاكد من كلمة المرور واعد المحاولة');
        }
    }

    public function register(AdminRegisterWebRequest $request){
        if($request->has('password')){
            $request['password']  = Hash::make($request->get('password'));
        }
        $admin =  $this->adminRepository->create($request->all());
        if($admin){
            return new DataSuccess(data:$admin,resourceData: new UserResource($admin),message: 'تم انشاء الحساب بنجاح');
        }else{
            return new DataFailed(message: 'حصل خطآ ما اثناء انشاء الحساب');
        }
    }

    public function find(GoToEditeAdminWebRequest $request)
    {
        $admin = $this->adminRepository->find($request->get('id'));
        if($admin){
            return new DataSuccess(data:$admin,message: 'تم اضافة الموظف بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الموظف');
        }
    }

    public function update(AdminEditeWebRequest $request)
    {
        $lastAdmin = $this->adminRepository->find($request->get('id'));
        if($request->has('password')){
            if($lastAdmin->password !== $request->get('password')){
                $request['password']  = Hash::make($request->get('password'));
            }
        }
        $admin = $this->adminRepository->update($request->all());
        if($admin){
            return new DataSuccess(data:$admin,message: 'تم تعديل الموظف بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الموظف');
        }
    }

    public function delete(AdminDeleteWebRequest $request)
    {
        $admin = $this->adminRepository->delete($request->get('id'));
        if($admin){
            return new DataSuccess(data:$admin,message: 'تم حذف الموظف بنجاح');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء حذف الموظف');
        }
    }

}
