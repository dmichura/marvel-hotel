<?php

class Application {
    private Request $req;
    private Database $db;
    private Router $router;
    private Response $res;

    private array $nav = [
        ['', 'Strona główna'],
        ['rooms', 'Strona główna'],
    ];

    public function __construct($routes = [])
    {
        $this->req = new Request();
        $this->db = new Database();
        $this->router = new Router( $this->req, $routes );
        $this->res = new Response();
    }

    public function run()
    {
        $this->router->resolve();
        $this->res->resolve();
    }
}

?>