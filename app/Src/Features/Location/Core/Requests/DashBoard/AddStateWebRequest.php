<?php

namespace Src\Features\Location\Core\Requests\DashBoard;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class AddStateWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }


    public function messages()
    {
        return [

        ];
    }
}
