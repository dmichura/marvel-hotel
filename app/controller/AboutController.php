<?php

class AboutController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'O nas',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {
        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data;
        new NotFoundView($this->page);
        $res->setCode(404);
    }

}

?>