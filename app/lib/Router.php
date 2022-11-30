<?php

class Router {
    private const allowedMethod = ['GET', 'POST'];
    private $routing = [];

    public function __construct(Request $request)
    {
        
    }

    public function addRoute($method, $path, $callback)
    {
        if ( !in_array($method, self::allowedMethod) )
        {
            return false;
        }

        $routing[$method][$path] = $callback;
    }

}

?>