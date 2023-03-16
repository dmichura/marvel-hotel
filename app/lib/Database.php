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

        if(!$this->isConnected()){
            // echo 'true';
            return false;
        }
        return true;
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

    public function query($query, $params=[]) : array
    {
        $stmt = $this->con->prepare( $query );
        // if (count($params) > 0) {
        //     $build = array_values($params);
        //     array_unshift($build, implode("", array_keys($params)));
        //     $stmt->bind_param(...$build);
        // }
        $stmt->execute();
        $result = $stmt->get_result();
        if($result)
        {
            $arrResult = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $result->free();
            if ( count( $arrResult ) < 0 ) {
                return [];
            }
            return $arrResult;
        }
        else
        {
            return [];
        }


    }

    public function close() : bool
    {
        // echo "close";
        if( !self::isConnected() ) {
            return false;
        }

        $this->con->close();
        $this->con = null;
        return true;
    }


}

?>