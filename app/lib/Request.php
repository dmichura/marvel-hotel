<?php

class Request {

    private string $path;
    private string $method;
    private array $params = [];

    public function __construct()
    {
        // _log($_SERVER);
        $this->path = preg_replace( '/\/index.php/', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = explode("&", $_SERVER['QUERY_STRING']);
        _log( self::getPath() );

    }

    public function getPath() : string {
        return $this->path;
    }
    public function getMethod() : string {
        return $this->method;
    }
    public function getParams() : array {
        return $this->params;
    }
}

?>