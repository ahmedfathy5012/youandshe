<?php

namespace Src\Features\Booking\Core\Requests;

use Src\Base\Requests\ApiRequest;

class CheckPriceRequest extends  ApiRequest
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
