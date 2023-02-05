<?php

class Application {
    private Request $req;
    private Database $db;
    private Router $router;
    private Response $res;

    public array $nav = [
        ['home', 'Strona główna'],
        ['rooms', 'Pokoje'],
    ];

    public function __construct($routes = [])
    {
        $this->req = new Request();
        $this->db = new Database();
        $this->res = new Response();
        $this->router = new Router($this->req, $this->res, $routes, $this->nav);
    }

    public function run()
    {
        $this->router->resolve();
        $this->res->resolve();
    }
}

?>