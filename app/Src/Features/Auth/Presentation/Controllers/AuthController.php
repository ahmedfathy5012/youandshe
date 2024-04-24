<?php

namespace Src\Features\Auth\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Features\Auth\Core\Requests\ChangePasswordRequest;
use App\Src\Features\Auth\Core\Requests\CheckPhoneRequest;
use App\Src\Features\Auth\Core\Requests\LoginRequest;
use App\Src\Features\Auth\Core\Requests\RegisterRequest;
use App\Src\Features\Auth\Core\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Src\Features\Auth\Data\Models\User;
use Src\Features\Auth\Domain\Services\AuthService;
use Src\Features\Auth\Domain\Services\ChangePasswordService;
use Src\Features\Auth\Domain\Services\CheckPhoneService;
use Src\Features\Auth\Domain\Services\LoginService;
use Src\Features\Auth\Domain\Services\ResetPasswordService;
use Src\Features\Auth\Domain\Services\VerifyPhoneService;

class AuthController extends Controller
{
   private AuthService $authService;

   private LoginService $loginService;
   private ChangePasswordService $changePasswordService;
   private VerifyPhoneService $verifyPhoneService;
   private ResetPasswordService $resetPasswordService;
   private CheckPhoneService $checkPhoneService;

    /**
     * @param AuthService $authService
     * @param LoginService $loginService
     * @param ChangePasswordService $changePasswordService
     * @param VerifyPhoneService $verifyPhoneService
     * @param ResetPasswordService $resetPasswordService
     * @param CheckPhoneService $checkPhoneService
     */
    public function __construct(AuthService $authService, LoginService $loginService, ChangePasswordService $changePasswordService, VerifyPhoneService $verifyPhoneService, ResetPasswordService $resetPasswordService, CheckPhoneService $checkPhoneService)
    {
        $this->authService = $authService;
        $this->loginService = $loginService;
        $this->changePasswordService = $changePasswordService;
        $this->verifyPhoneService = $verifyPhoneService;
        $this->resetPasswordService = $resetPasswordService;
        $this->checkPhoneService = $checkPhoneService;
    }


    public function register(RegisterRequest $request){
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
