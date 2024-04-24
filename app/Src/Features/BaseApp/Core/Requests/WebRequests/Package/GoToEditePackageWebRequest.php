<?php

namespace Src\Features\BaseApp\Core\Requests\WebRequests\Package;

use Src\Base\Requests\ApiRequest;
use Src\Base\Requests\WebRequest;

class GoToEditePackageWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:packages,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
