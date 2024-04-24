<?php

namespace Src\Features\BaseApp\Core\Requests\WebRequests\Package;


use Src\Base\Requests\WebRequest;

class AddPackageWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric'
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
