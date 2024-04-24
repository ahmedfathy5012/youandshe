<?php

namespace App\Src\Features\Auth\Core\Requests;

use Src\Base\Requests\ApiRequest;

class ChangePasswordRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' =>  'required',
            'new_password' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'=>"يجب ادخال كلمة المرور القديمة",
            'new_password.required'=>"يجب ادخال كلمة المرور الجديدة",
        ];
    }

}
