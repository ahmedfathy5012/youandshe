<?php

namespace Src\Features\BaseApp\Core\Requests\WebRequests\Slider;

use Src\Base\Requests\ApiRequest;
use Src\Base\Requests\WebRequest;

class GoToSliderWebRequest extends  WebRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:sliders,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
