<?php

namespace Src\Features\Location\Core\Requests\DashBoard\City;

use Illuminate\Foundation\Http\FormRequest;
use Src\Base\Requests\WebRequest;

class GoToEditeCityWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:cities,id',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
