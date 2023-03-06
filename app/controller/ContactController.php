<?php

class ContactController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Kontakt',
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
        new ContactModel($this->page);
        new ContactView($this->page);
    }

}

?>