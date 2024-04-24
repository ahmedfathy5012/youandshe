<?php

namespace Src\Features\Permission\Core\Requests\WebRequests\Permission;

use Src\Base\Requests\ApiRequest;

class GoToEditePermissionWebRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:permissions,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
