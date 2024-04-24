<?php

namespace App\Src\Features\Auth\Core\Requests;

use Src\Base\Requests\ApiRequest;

class RegisterRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' =>  'required|unique:users,phone',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>"يجب ادخال رقم الهاتف",
            'phone.unique'=>"هذا الهاتف مستخدم من قبل",
            'password.required'=>"يجب ادخال كلمة السر",
        ];
    }

}
