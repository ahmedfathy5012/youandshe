<?php

namespace Src\Features\Location\Core\Requests;

use Src\Base\Requests\ApiRequest;

class SetAddressActiveRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required',
        ];
    }


    public function messages()
    {
        return [

        ];
    }
}
