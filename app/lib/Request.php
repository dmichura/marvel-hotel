<?php

class Request {

    private string $path;
    private string $method;
    private array $params = [];

    public function __construct()
    {
        $this->path = preg_replace('/^\//', '', preg_replace( '/\/index.php/', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
        $this->method = $_SERVER['REQUEST_METHOD'];

        $params = explode("&", $_SERVER['QUERY_STRING']);
        if( count($params) > 0 ) {
            $this->params = array();
            if( gettype($params) === "array" && count($params) > 0 )
            {
                foreach ( $params as $param ):
                    // _log($param);
                    $paramTable = explode("=", $param);
                    // print_r($paramTable[0]);
                    if( isset($paramTable[0]) && isset($paramTable[1]) && $paramTable[0] != "") {
                        $this->params[$paramTable[0]] = $paramTable[1];
                    }

                endforeach;
            }
        }

        // print_r(count($this->params ));

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