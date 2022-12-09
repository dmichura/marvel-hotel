<?php

class Router {
    private const allowedMethod = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
    ];
    private Request $req;

    private array $routes = [
        // method => [path, callback]
    ];

    public function __construct(Request &$req, $routes = [])
    {
        // _log($routes);
        $this->req = $req;
        if (count($routes) > 0) {
            foreach ($routes as $val)
            {
                if (in_array($val[0], self::allowedMethod)) {
                    $this->routes[$val[0]][] = [$val[1], $val[2]];
                }
            }
        }

        _log($this->routes);
    }

    public function resolve()
    {
        $path = $this->req->getPath();
        $method = $this->req->getMethod();
        if(
            !in_array($method, self::allowedMethod
        )) {
            $method = 'GET';
            $path = '/404';
        }
        _log()
        // call_user_func($this->routes[$method][$path][1]);
    }

}

?>