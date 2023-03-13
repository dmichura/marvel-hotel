<?php

class User {
    private $session = null;

    private $logged = false;
    public function __construct($session)
    {
        $this->session = $session;
        if( ($this->session->get("loggedin") == true) && $this->session->get("loggedin_id") != false ) {
            $this->logged = true;
        }
    }

    public function isLogged()
    {
        return $this->logged;
    }

    public function getRole() {
        if( $this->isLogged() ) {
            return "User";
        }
        return "Unlogged";
    }
}



?>