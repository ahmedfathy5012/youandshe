<?php


use Illuminate\Http\JsonResponse;

function exceptionResponse(string $message = '' , array $errors = [],int $status=JsonResponse::HTTP_BAD_REQUEST,){
    throw new \Illuminate\Http\Exceptions\HttpResponseException(
        response()->json(
            [
                'status' => false,
                'message' => $message,
                'errors' => $errors
            ],
            $status
//            JsonResponse::HTTP_BAD_REQUEST
        )
    );
}
