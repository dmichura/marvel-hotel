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
    private int $code = 400;
    private $redirect = null;
    public function __construct()
    {
        
    }

    public function setRedirect(string $redirect) : bool 
    {
        $this->redirect = $redirect;
        return true;
    }
    public function setCode(int $code) : bool
    {

        if(!self::codes[$code]){
            $code = 400;
        }
        $this->code = $code;
        return true;
    }

    public function resolve() : void
    {
        if(!self::codes[$this->code]) {
            $this->code = 400;
        }
        header("HTTP/1.1 $this->code ".self::codes[$this->code]);
        if(!is_null($this->redirect)) {
            header("Location: /{$this->redirect}");
        }
        die();
    }
}

?>