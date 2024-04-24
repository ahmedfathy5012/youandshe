<?php

namespace Src\Features\Location\Core\Requests\DashBoard;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class GoToEditeStateWebRequest extends  WebRequest
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
