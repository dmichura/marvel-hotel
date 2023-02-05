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
        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data;
        new HomeModel($this->page);
        new HomeView($this->page);
        $res->setCode(200);
    }

}

?>