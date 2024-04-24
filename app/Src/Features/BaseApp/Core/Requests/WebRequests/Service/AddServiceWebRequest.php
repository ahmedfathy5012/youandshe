<?php

namespace Src\Features\BaseApp\Core\Requests\WebRequests\Service;


use Src\Base\Requests\WebRequest;

class AddServiceWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'nullable|numeric'
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
