<?php

namespace Src\Features\Barber\Core\Requests;

use Src\Base\Requests\ApiRequest;

class AddBarberReviewRequest extends  ApiRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'barber_id' => 'required',
            'rate' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
