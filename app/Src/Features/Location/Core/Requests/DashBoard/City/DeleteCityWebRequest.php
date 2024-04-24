<?php

namespace Src\Features\Location\Core\Requests\DashBoard\City;

use Src\Base\Requests\WebRequest;

class DeleteCityWebRequest extends  WebRequest
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
