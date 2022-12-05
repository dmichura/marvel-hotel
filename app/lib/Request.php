<?php

class Request {

    private string $method = '';
    private string $path = '';
    public function __construct()
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->path = preg_replace("/\/index.php/", "", $_SERVER['REQUEST_URI']);
    }

    public function getMethod() : string {
        return $this->method;
    }
    public function getPath() : string {
        return $this->path;
    }
}

?>