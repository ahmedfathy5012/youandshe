<?php

namespace Src\Features\Location\Core\Requests\DashBoard\AddressType;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class EditeAddressTypeWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'id' => 'required|exists:address_types,id',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
