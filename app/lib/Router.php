<?php
class Router {
    private const allowedMethod = ['GET', 'POST'];
    private $routing = [];
    private Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addRoute($method, $path, $callback) : bool
    {
        if ( !in_array($method, self::allowedMethod) )
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

        if( isset($this->routing[$method][$path]) )
        {
            call_user_func($this->routing[$method][$path], $db);
        }
        return false;
    }

}

?>