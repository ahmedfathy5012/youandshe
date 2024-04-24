<?php

namespace Src\Features\Location\Core\Requests\DashBoard\AddressType;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class AddAddressTypeWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }


    public function messages()
    {
        return [

        ];
    }
}
