<?php

class HomeController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Strona główna',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {
        $res->setCode(200);
        $res->resolve();
        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data['nav'];
        new HomeModel($this->page);
        new HomeView($this->page);
 
    }

}

?>