<?php

namespace Src\Features\Permission\Core\Requests\WebRequests\Permission;

use Src\Base\Requests\ApiRequest;

class AddPermissionWebRequest extends  ApiRequest
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
