<?php

class AdminController {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Admin',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {
        $res->setCode(200);
        $res->resolve();
        $this->page['path'] = $req->getPath();
        $this->page['params'] = $req->getParams();
        $this->page['nav'] = $data['nav'];
        $this->page['db'] = $data['db'];
        $this->page['user'] = $data['user'];

        new AdminModel($this->page);
        new AdminView($this->page);
    }
}

?>