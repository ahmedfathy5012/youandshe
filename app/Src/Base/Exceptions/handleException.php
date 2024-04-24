<?php

function handleException111(Exception $e)
{
    if($e instanceof \Illuminate\Http\Exceptions\HttpResponseException){
        throw $e;
    }
}
