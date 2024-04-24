<?php

namespace Src\Features\BaseApp\Core\Requests;

use Src\Base\Requests\ApiRequest;

class PackageServicesRequest extends  ApiRequest
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
            'id.required'=>"the id field is required",
        ];
    }
}
