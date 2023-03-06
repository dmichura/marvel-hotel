<?php

class RoomsController implements Controller {
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
        $res->setCode(200);
        $res->resolve();
        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data['nav'];
        $this->page['db'] = $data['db'];
        new RoomsModel($this->page);
        new RoomsView($this->page);
    }

}

?>