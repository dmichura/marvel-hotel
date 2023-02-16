<?php

class GalleryController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Galeria',
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
        new GalleryView($this->page);
    }

}

?>