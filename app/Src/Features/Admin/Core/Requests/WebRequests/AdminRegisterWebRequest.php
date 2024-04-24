<?php

namespace App\Src\Features\Admin\Core\Requests\WebRequests;

use Src\Base\Requests\WebRequest;

class AdminRegisterWebRequest extends WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' =>  'required|unique:admins,phone',
            'name' =>    'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>     "يجب ادخال رقم الهاتف",
            'phone.unique'=>       "هذا الهاتف مستخدم من قبل",
            'password.required'=>  "يجب ادخال كلمة السر",
        ];
    }

}
