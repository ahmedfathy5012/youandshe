<?php

namespace App\Src\Base\Exceptions;

class RepositoryException extends  \Exception
{

    public function __construct(string $message='',int $statusCode = 400 , )
    {
        $this->message = $message;
        $this->code = $statusCode;
    }
}


