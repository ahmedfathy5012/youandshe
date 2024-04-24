<?php

namespace Src\Features\Location\Core\Requests;

use Src\Base\Requests\ApiRequest;

class AddAddressRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lat' => 'required',
            'lon' => 'required',
            'address' => 'required',
            'address_type_id' => 'required',
            'name' => 'required',
        ];
    }


    public function messages()
    {
        return [

        ];
    }
}
