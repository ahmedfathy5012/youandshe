<?php

namespace Src\Base\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();


    public function body(){

    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        if( !empty($errors) ) {
            $transformedErrors = [];
            foreach($errors as $field => $message) {
                $transformedErrors[] = [
                    $field => $message[0]
                ];
            }

            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json(
                    [
                        'status' => false,
                        'message' => $message[0],
                        'errors' => $transformedErrors
                    ],
                    JsonResponse::HTTP_BAD_REQUEST
                )
            );
        }
    }

    // abstract public function messages();


}
