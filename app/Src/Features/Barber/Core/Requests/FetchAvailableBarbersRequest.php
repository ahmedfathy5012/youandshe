<?php

namespace Src\Features\Barber\Core\Requests;

use Src\Base\Requests\ApiRequest;

class FetchAvailableBarbersRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        ];
    }


    public function messages()
    {
        return [

        ];
    }
}
