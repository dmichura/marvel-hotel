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
        // print_r($req->getMethod());
        $method = $req->getMethod();
        $params = $req->getParams();
        // echo $method;
        if ($method == 'GET') {
            $res->setCode(200);
            $res->resolve();
            $this->page['path'] = $req->getPath();
            $this->page['nav'] = $data['nav'];
            $this->page['user'] = $data['user'];
            if( gettype($params) === "array" && count($params) > 0 && isset($params['type']) && gettype($params['type']) == "string" )
            {

                $typeRequest = $params['type'];
                if($typeRequest == "sendedTicket") {
                    $this->page['data'] = array(
                        "sendTicket" => true
                    );

                }
            }

            new ContactModel($this->page);
            new ContactView($this->page);
        }
        else if($method == "POST") {
            // echo $method;

            if( gettype($params) === "array" && count($params) > 0 && isset($params['type']) && gettype($params['type']) == "string" )
            {
                $typeRequest = $params['type'];
                if( $typeRequest == "addTicket" ) {
                    echo "<pre>";
                    // print_r($_POST);
                    echo "</pre>";
                    $title = ( isset($_POST['contact__form-title']) &&  gettype($_POST['contact__form-title']) == "string") ? $_POST['contact__form-title'] : false;
                    $email = ( isset($_POST['contact__form-email']) &&  gettype($_POST['contact__form-email']) == "string") ? $_POST['contact__form-email'] : false;
                    $reason = ( isset($_POST['contact__form-content']) &&  gettype($_POST['contact__form-content']) == "string") ? $_POST['contact__form-content'] : false;
                    if ($title && $email && $reason) {
                        $data['db']->query("INSERT INTO `ticket`(`title`, `email`, `reason`, `status`, `created`) VALUES ('$title', '$email', '$reason', 'open', NOW())");
                        // $page['data'] = array(
                        //     "ticketAdded" => $result[0]
                        // );
                        // _log($data);
                        $res->setCode(200);
                        $res->setRedirect("contact?type=sendedTicket");
                        $res->resolve();
                        // new ContactModel($this->page);
                        // new ContactView($this->page);
                    }
                    else
                    {
                        $res->setCode(301);
                        $res->setRedirect("contact");
                        $res->resolve();
                        die();
                    }
                }
                else
                {

                    die();
                }
            }
        }

    }

}

?>