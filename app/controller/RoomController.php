<?php

class RoomController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Pokój',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {

        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data['nav'];
        $this->page['user'] = $data['user'];
        $this->page['db'] = $data['db'];

        if( $this->page['user']->isLogged() ) {
            $params = $req->getParams();
            if( gettype($params) === "array" && count($params) > 0 && isset($params['id']) && gettype(intval($params['id'])) == "integer" && intval($params['id']) > 0 )
            {
                // echo $params['id'];
                $res->setCode(200);
                // $res->resolve();
                $res->resolve();
                $this->page['data']['id'] = $params['id'];
                $this->page['data']['month'] = ( isset($params['month']) && intval($params['month']) >= 1 && intval($params['month']) <= 12 ) ? intval($params['month']) : false;
                $this->page['data']['year'] = ( isset($params['year']) && intval($params['year']) >= 2000) ? intval($params['year']) : false;
                new RoomModel($this->page);
                new RoomView($this->page);
                die();
            }
            else
            {
                $res->setCode(301);
                $res->setRedirect("rooms");

            }
        }
        else
        {
            $res->setCode(301);
            $res->setRedirect("rooms");
        }
        $res->resolve();
        die();

    }

}

?>