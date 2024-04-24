<?php

namespace Src\Features\Permission\Core\Requests\WebRequests\Permission;

use Src\Base\Requests\ApiRequest;

class DeletePermissionWebRequest extends  ApiRequest
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
