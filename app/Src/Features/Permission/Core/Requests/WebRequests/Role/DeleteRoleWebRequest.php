<?php

namespace Src\Features\Permission\Core\Requests\WebRequests\Role;

use Src\Base\Requests\ApiRequest;

class DeleteRoleWebRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
