<?php

namespace Src\Features\Booking\Core\Requests\WebRequests\CancelReason;

use Src\Base\Requests\ApiRequest;
use Src\Base\Requests\WebRequest;

class AddCancelReasonWebRequest extends  WebRequest
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
