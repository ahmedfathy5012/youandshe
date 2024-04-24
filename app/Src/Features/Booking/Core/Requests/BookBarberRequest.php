<?php

namespace Src\Features\Booking\Core\Requests;

use Src\Base\Requests\ApiRequest;

class BookBarberRequest extends  ApiRequest
{


    public function body()
    {
      return [
           'service_ids',      // nullable
           'package_id',       // nullable
           'coupon',           // nullable
           'barber_id',        // required
           'date',             // required
           'time',             // required
           'address_id',       // required
       ];
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'barber_id' =>  'required',
            'date' => 'required',
            'time' => 'required',
            'address_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'barber_id.required'=>"يجب اختيار حلاق",
            'date.required'=>"يجب اختيار يوم مناسب",
            'time.required'=>"يجب اختيار يوم مناسب",
            'address_id.required'=>"يجب اختيار مكانك",
        ];
    }



}
