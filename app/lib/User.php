<?php

class User {
    private $session = null;

    private $logged = false;
    // types:
    //  0 - information
    //  1 - error
    private $messages = [];
    public function __construct($session)
    {
        $this->session = $session;
        $loggedIn = $this->session->get("loggedin");
        $loggedInId = $this->session->get("loggedin_id");
        if( isset($loggedIn) && $loggedIn == 1 && isset($loggedInId) ) {
            $this->logged = true;
            
        }
        // var_dump($this->logged);
        // _log($_SESSION);
        $messages = $this->session->get("messages");
        if( isset($messages) && gettype($messages) == "string" ) {
            $messages = json_decode($messages);
            $this->messages = (gettype($messages) == "array") ? $messages : [];
        }
    }

    public function login($login, $id, $roleID, $roleName){
        if( !self::isLogged() ){
            
            $this->logged = true;
            $this->session->set("loggedin", 1); 
            $this->session->set("logged_login", $login); 
            $this->session->set("logged_id", $id);
            $this->session->set("logged_roleID", $roleID);
            $this->session->set("logged_roleName", $roleName);
        }
        return false;
    }

    public function logout() {
        if( self::isLogged() ){
            $this->logged = false;
            $this->session->set("loggedin", 0);
            $this->session->delete("logged_login");
            $this->session->delete("logged_id");
            return true;
        }
        return false;
    }

    public function isLogged()
    {
        return $this->logged;
    }

    public function message($text, $type=0) : bool {
        if ( isset($text) && $text != "" ) {
            array_push($this->messages, array("text"=>$text, "type"=>$type));
            if ( $this->session->set("messages", json_encode($this->messages)) ) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function showMessages() {
        // return $this->messages;
        $messages = $this->getMessages();
        $html = "";
        if ( isset($messages) && gettype($messages) == "array" && count($messages) > 0 ) {
            $html.="<div class='messages__wrapper'>";
            foreach ($messages as $message) :
                if ($message) {
                    $className = "message__information";
                    if($message->type == 1)
                    {
                        $className = "message__error";
                    }
                    $html .= "<div class='$className'> {$message->text} </div>";
                }
            endforeach;
            $html.="</div>";
        }
        // _log($messages);
        return $html;
    }
    public function getMessages() {
        $arr = $this->messages;
        $this->messages = [];
        $this->session->set("messages", json_encode([]));
        return $arr;
    }

    public function getRole() {
        if( $this->isLogged() ) {
            return $this->session->get("logged_roleName");
        }
        return "Unlogged";
    }

    public function getLogin()
    {
        if( $this->isLogged() ) {
            return $this->session->get("logged_login");
        }
        return false;
    }

    public function getID()
    {
        if( $this->isLogged() ) {
            return $this->session->get("logged_id");
        }
        return false;
    }

}



?>