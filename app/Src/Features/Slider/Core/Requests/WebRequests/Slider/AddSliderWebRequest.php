<?php

namespace Src\Features\Slider\Core\Requests\WebRequests\Slider;


use Src\Base\Requests\WebRequest;

class AddSliderWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required',
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
