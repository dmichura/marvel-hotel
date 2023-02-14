<?php

class Application {
    private Request $req;
    private Database $db;
    private Router $router;
    private Response $res;

    public array $nav = [
        // rote, ls name
        ['home', 'homepage'],
        ['about', 'aboutus'],
        ['gallery', 'gallery'],
        ['contact', 'contact'],
        ['rooms', 'rooms'],
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