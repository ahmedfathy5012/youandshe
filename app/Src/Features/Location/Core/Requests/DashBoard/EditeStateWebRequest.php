<?php

namespace Src\Features\Location\Core\Requests\DashBoard;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class EditeStateWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'id' => 'required|exists:states,id',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
