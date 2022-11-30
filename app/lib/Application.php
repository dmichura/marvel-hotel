<?php

class Application {

    private Request $request;
    private Router $router;

    public function __construct()
    {
        $request = new Request();
        $router = new Router($this->request);
    }


    public function addRoute( $method, $path, $callback )
    {
        $this->router->addRoute( $method, $path, $callback );
    }
}

?>