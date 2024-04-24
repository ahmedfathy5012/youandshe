<?php

namespace App\Src\Features\Admin\Core\Requests\WebRequests;

use Src\Base\Requests\WebRequest;

class AdminLoginWebRequest extends WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
                'phone' => 'required|exists:admins,phone',
                'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=> "يجب ادخال رقم الهاتف",
            'password.required'=> "يجب ادخال كلمة السر",
        ];
    }

}
