<?php

namespace App\Utilities;

class Functions
{
    public static function setResponseCode($code, $reason = null)
    {
        $code = intval($code);
        if (version_compare(phpversion(), '5.4', '>') && is_null($reason)) {
            http_response_code($code);
        } else {
            header(trim("HTTP/1.1 {{$code}} {{$reason}}"));
        }
    }
    // return api
    public static function returnAPI($data, $message = "OK")
    {
        if ($data) {
            Functions::setResponseCode(200, $message);
        } else {
            header(trim("HTTP/1.1 404"));
            Functions::setResponseCode(404, $message);
        }
        echo \json_encode(compact('data'));
    }
}
