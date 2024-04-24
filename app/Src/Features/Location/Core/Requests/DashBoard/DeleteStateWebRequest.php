<?php

namespace Src\Features\Location\Core\Requests\DashBoard;

use Src\Base\Requests\WebRequest;

class DeleteStateWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:states,id',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
