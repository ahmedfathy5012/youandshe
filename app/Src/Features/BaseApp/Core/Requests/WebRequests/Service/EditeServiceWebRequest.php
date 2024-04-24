<?php

namespace Src\Features\BaseApp\Core\Requests\WebRequests\Service;

use Src\Base\Requests\ApiRequest;
use Src\Base\Requests\WebRequest;

class EditeServiceWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:services,id',
            'name' => 'required',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
