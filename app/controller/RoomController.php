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
        $this->page['method'] = $req->getMethod();
        $this->page['nav'] = $data['nav'];
        $this->page['user'] = $data['user'];
        $this->page['db'] = $data['db'];

        $method = $req->getMethod();
        $params = $req->getParams();

        if( $this->page['user']->isLogged() ) {
            // $this->page['user']->message("Konto o takim loginie juz istnieje!", 1);
            // $params = $req->getParams();
            if( gettype($params) === "array" && count($params) > 0 && isset($params['id']) && gettype(intval($params['id'])) == "integer" && intval($params['id']) > 0 )
            {
                if ($method == 'GET') {
    
                        // echo $params['id'];
                        $res->setCode(200);
                        // $res->resolve();
                        $res->resolve();
                        $this->page['data']['id'] = $params['id'];
                        $this->page['data']['month'] = ( isset($params['month']) && $params['month'] != "" && intval($params['month']) >= 1 && intval($params['month']) <= 12 ) ? intval($params['month']) : false;
                        $this->page['data']['year'] = ( isset($params['year']) && intval($params['year']) >= 2000) ? intval($params['year']) : false;
                        
                        new RoomModel($this->page);
                        new RoomView($this->page);
                        die();
                }
    
                else if($method == "POST") {
                    $this->page['data']['id'] = $params['id'];
                    new RoomModel($this->page);
                    // var_dump($this->page['data']);
                    if($this->page['data']['create']) {
                        // _log($this->page['data']);
                        $this->page['db']->query("INSERT INTO `reservation`( `room_id`, `account_id`, `start_time`, `end_time`) VALUES ({$this->page['data']['id']}, {$this->page['data']['account_id']}, '{$this->page['data']['start']}', '{$this->page['data']['end']}')");
                    }
                    else
                    {
                        if( $this->page['data']['end'] >= $this->page['data']['start'] ) {
                            $this->page['user']->message("W tym okresie ten pokój jest zajęty!", 1);
                        }
                        else
                        {
                            $this->page['user']->message("Podaj właściwy okres czasu!", 1);
                        }

                    }

                    $res->setCode(301);
                    $res->setRedirect("room?id={$params['id']}");
                }
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