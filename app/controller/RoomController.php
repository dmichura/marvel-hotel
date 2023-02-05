<?php

class RoomController implements Controller {
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
        $this->page['nav'] = $data;
        new RoomModel($this->page);
        new RoomView($this->page);
        $res->setCode(200);
    }

}

?>