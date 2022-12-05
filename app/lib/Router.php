<?php
class Router {
    private const allowedMethod = ['GET', 'POST', 'PUT', 'DELETE'];
    private $routing = [];
    private Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addRoute($method, $path, $callback) : bool
    {
        if ( !in_array($method, self::allowedMethod) && $method != "ALL" )
        {
            return false;
        }

        $this->routing[$method][$path] = $callback;
        return true;
    }

    public function resolve(Database $db) : bool
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        if ( 
            !in_array($method, self::allowedMethod)
            || empty($this->routing[$method][$path])
        )
        {
            $method = "ALL";
            $path = "*";
        }

        call_user_func($this->routing[$method][$path], $db);
        return true;
    }

}

?>