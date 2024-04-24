<?php

namespace Src\Features\Location\Core\Requests\DashBoard\AddressType;

use Src\Base\Requests\WebRequest;

class DeleteAddressTypeWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:address_types,id',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
