<?php

namespace App\Src\Features\Auth\Core\Requests;

use Src\Base\Requests\ApiRequest;

class CheckPhoneRequest extends ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'=>"يجب ادخال رقم الهاتف",
        ];
    }

}
