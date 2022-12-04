<?php

class Application {

    private Database $db;
    private Request $request;
    private Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }


    public function addRoute( $method, $path, $callback ) : bool
    {
        return $this->router->addRoute( $method, $path, $callback );
    }

    public function run() : void {
        $this->db = new Database();
        $this->router->resolve($this->db);
        $this->db->close();
    }
}

?>