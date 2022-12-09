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
                    $path = preg_replace('/^\//', '', $val[1]);
                    $this->routes[$val[0]][$path] = $val[2];
                }
            }
        }

        // _log($this->routes);
    }

    public function resolve()
    {
        $path = $this->req->getPath();
        $method = $this->req->getMethod();
        if(
            !in_array($method, self::allowedMethod) ||
            !isset($this->routes[$method][$path])
        ) {
            redirect('404');
        }
        // _log($this->routes[$method][$path]);
        call_user_func($this->routes[$method][$path]);
    }

}

?>