<?php

namespace Src\Features\Auth\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Features\Auth\Core\Requests\BarberRegisterRequest;
use App\Src\Features\Auth\Core\Requests\ChangePasswordRequest;
use App\Src\Features\Auth\Core\Requests\CheckPhoneRequest;
use App\Src\Features\Auth\Core\Requests\LoginRequest;
use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use App\Src\Features\Auth\Core\Requests\ResetPasswordRequest;
use Src\Features\Auth\Domain\BarberServices\BarberChangePasswordService;
use Src\Features\Auth\Domain\BarberServices\BarberCheckPhoneService;
use Src\Features\Auth\Domain\BarberServices\BarberLoginService;
use Src\Features\Auth\Domain\BarberServices\BarberRegisterService;
use Src\Features\Auth\Domain\BarberServices\BarberResetPasswordService;
use Src\Features\Auth\Domain\BarberServices\BarberVerifyPhoneService;



class BarberAuthController extends Controller
{
   private BarberRegisterService $authService;
   private BarberLoginService $loginService;
   private BarberChangePasswordService $changePasswordService;
   private BarberVerifyPhoneService $verifyPhoneService;
   private BarberResetPasswordService $resetPasswordService;
   private BarberCheckPhoneService $checkPhoneService;

    /**
     * @param BarberRegisterService $authService
     * @param BarberLoginService $loginService
     * @param BarberChangePasswordService $changePasswordService
     * @param BarberVerifyPhoneService $verifyPhoneService
     * @param BarberResetPasswordService $resetPasswordService
     * @param BarberCheckPhoneService $checkPhoneService
     */
    public function __construct(BarberRegisterService $authService, BarberLoginService $loginService, BarberChangePasswordService $changePasswordService, BarberVerifyPhoneService $verifyPhoneService, BarberResetPasswordService $resetPasswordService, BarberCheckPhoneService $checkPhoneService)
    {
        $this->authService = $authService;
        $this->loginService = $loginService;
        $this->changePasswordService = $changePasswordService;
        $this->verifyPhoneService = $verifyPhoneService;
        $this->resetPasswordService = $resetPasswordService;
        $this->checkPhoneService = $checkPhoneService;
    }


    public function register(BarberRegisterRequest $request){
        return $this->authService->register($request)->response();
    }

    public function login(LoginRequest $request){
        return $this->loginService->login($request)->response();
    }

    public function changePassword(ChangePasswordRequest $request){
        return $this->changePasswordService->changePassword($request)->response();
    }

    public function resetPassword(ResetPasswordRequest $request){
        return $this->resetPasswordService->resetPassword($request)->response();
    }

    public function checkPhone(CheckPhoneRequest $request){
        return $this->checkPhoneService->checkPhone($request)->response();
    }

    public function verifyPhone(){
        return $this->verifyPhoneService->verifyPhone()->response();
    }




}
