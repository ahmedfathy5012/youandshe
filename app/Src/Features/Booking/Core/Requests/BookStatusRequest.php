<?php

namespace Src\Features\Booking\Core\Requests;

use Src\Base\Requests\ApiRequest;

class BookStatusRequest extends  ApiRequest
{


    public function body()
    {
      return [
           'booking_id',      // required

       ];
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'booking_id' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'booking_id.required'=>"يجب ادخال الحجز",
        ];
    }



}
