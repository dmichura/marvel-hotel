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
        $this->router = new Router($this->req, $this->res, $routes, array("nav"=>$nav, "db"=>$this->db));
    }

    public function run()
    {
        $re = $this->db->query("SELECT * FROM room");
        // _log($re);
        $this->router->resolve();

    }
}

?>