<?php

namespace App\Src\Base\Core\Helpers;

use Exception;
use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;

trait ExceptionHelper
{
    protected function handleException(Exception $e)
    {
        if($e instanceof \Illuminate\Http\Exceptions\HttpResponseException){
            throw $e;
        }else{
            throw  exceptionResponse($e->getMessage() ?? "حدث خطآ ما");
        }
    }
}
