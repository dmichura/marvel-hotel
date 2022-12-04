<?php

class Database {
    private $con = null;
    public function __construct()
    {
        // open con
        $this->con = new mysqli( 
            config['db']['host'],
            config['db']['username'],
            config['db']['password'],
            config['db']['name'],
        );

        if($this->isConnected()){
            // echo 'true';
            return true;
        }
        return false;
    }

    public function isConnected() : bool
    {
        if(empty($this->con) || !is_object($this->con)){
            return false;
        }
        if(is_object($this->con) && $this->con->ping() !== TRUE)
        {
            return false;
        }
        return true;
    }

    public function close() : bool
    {
        // echo "close";
        return $this->con->close();
    }


}

?>