<?php

class NotFoundController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Nie ma takiej strony!',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {
        $res->setCode(404);
        $res->resolve();
        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data['nav'];
        new NotFoundView($this->page);
    }

}

?>