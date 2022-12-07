<?php

class Response {
    private const codes = [
        200 => "OK",
        201 => "Created",
        400 => "Bad Request",
        401 => "Unauthorized",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
    ];
    public function __construct($code)
    {
        if( isset(self::codes[$code]) ) {
            header("HTTP/1.1 $code ".self::codes[$code]);
            die();
        }
        else
        {
            header("HTTP/1.1 405 Method Not Allowed");
            die();
        }
    }
}

?>