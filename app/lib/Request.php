<?php

class Request {

    private string $method = '';
    private string $path = '';
    private array $params = [];
    public function __construct()
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $fullpath = explode("/", preg_replace("/\/index.php/", "", $_SERVER['REQUEST_URI']));
        $this->path = $fullpath[1];

        $this->params = array_splice($fullpath, 2);
    }

    public function getMethod() : string {
        return $this->method;
    }
    public function getPath() : string {
        return $this->path;
    }
    public function getParams() : array {
        return $this->params;
    }
    public function assignParams($params) : void {
        $npram = [];
        for ($i=0; $i < count($params); $i++) { 
            $npram[$params[$i]] = $this->params[$i];
        }
        $this->params = $npram;
    }
}

?>