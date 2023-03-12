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
        $this->page['db'] = $data['db'];

        // echo 'dsada';
        // new RoomController($req, $res, $data);
            $params = $req->getParams();
            if( gettype($params) === "array" && count($params) > 0 && isset($params['id']) && gettype(intval($params['id'])) == "integer" && intval($params['id']) > 0 )
            {
                // echo $params['id'];
                $res->setCode(200);
                $res->resolve();
                $this->page['data']['id'] = $params['id'];
                new RoomModel($this->page);
                new RoomView($this->page);
                
            }
            else
            {
                $res->setCode(301);
                $res->setRedirect("rooms");
                $res->resolve();
            }

            // $roomID = explode('=', $req->getParams()[0]);
            // _log($roomID);

    }

}

?>