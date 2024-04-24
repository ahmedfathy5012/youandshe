<?php

namespace App\Src\Features\Auth\Core\Requests;

use Src\Base\Requests\ApiRequest;

class ResetPasswordRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' =>  'required',
            'password' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>"يجب ادخال رقم الهاتف",
            'password.required'=>"يجب ادخال كلمة المرور",
        ];
    }

}
