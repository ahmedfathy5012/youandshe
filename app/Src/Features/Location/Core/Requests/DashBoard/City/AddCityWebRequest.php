<?php

namespace Src\Features\Location\Core\Requests\DashBoard\City;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class AddCityWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'state_id' => 'required|exists:states,id',
        ];
    }


    public function messages()
    {
        return [

        ];
    }
}
