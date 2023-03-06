<?php

class Application {
    private Session $session;
    private Request $req;
    private Database $db;
    private Router $router;
    private Response $res;

    private User $user;

    public function __construct($routes = [], $nav = [])
    {
        $this->session = new Session();
        $this->req = new Request();
        $this->db = new Database();
        $this->res = new Response();
        $this->user = new User($this->session);
        $this->router = new Router($this->req, $this->res, $routes, array("nav"=>$nav, "db"=>$this->db, "user" => $this->user));
    }

    public function run()
    {
        $this->router->resolve();

    }
}

?>