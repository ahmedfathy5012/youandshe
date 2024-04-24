<?php

namespace Src\Features\Booking\Core\Requests\WebRequests\CancelReason;

use Src\Base\Requests\ApiRequest;
use Src\Base\Requests\WebRequest;

class DeleteCancelReasonWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:cancel_reasons,id',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
