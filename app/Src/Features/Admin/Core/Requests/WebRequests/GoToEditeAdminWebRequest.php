<?php

namespace App\Src\Features\Admin\Core\Requests\WebRequests;

use Src\Base\Requests\WebRequest;

class GoToEditeAdminWebRequest extends WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
                'id' => 'required|exists:admins,id',

        ];
    }

    public function messages()
    {
        return [

        ];
    }

}
