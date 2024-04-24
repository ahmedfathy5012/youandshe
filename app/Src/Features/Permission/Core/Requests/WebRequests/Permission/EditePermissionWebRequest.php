<?php

namespace Src\Features\Permission\Core\Requests\WebRequests\Permission;

use Src\Base\Requests\ApiRequest;

class EditePermissionWebRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'id' => 'required|exists:permissions,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
