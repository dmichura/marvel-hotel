


<?php

class LogoutController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Pokoje',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {

        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data['nav'];
        $this->page['db'] = $data['db'];
        $this->page['user'] = $data['user'];

        $res->setCode(200);
        $res->setRedirect("account");


        if($this->page['user']->isLogged()) {
            $this->page['user']->logout();
            $res->setRedirect("home");
        }
        $res->resolve();
        die();

    }

}

?>