<?php

namespace Src\Features\BaseApp\Core\Requests\WebRequests\Service;

use Src\Base\Requests\ApiRequest;
use Src\Base\Requests\WebRequest;

class GoToAddServiceWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:services,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
