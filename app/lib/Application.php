<?php

class Application {
    private Request $req;
    private Database $db;
    private Router $router;
    private Response $res;

    public function __construct($routes = [], $nav = [])
    {
        $this->req = new Request();
        $this->db = new Database();
        $this->res = new Response();
        $this->router = new Router($this->req, $this->res, $routes, $nav);
    }

    public function run()
    {
        $this->router->resolve();
        $this->res->resolve();
    }
}

?>