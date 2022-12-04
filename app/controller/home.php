<?php

class Home {
    private string $name = 'Home';
    public function __construct(Database $db)
    {
        echo $this->name;
        // model
        model($this->name);
        //view
        view($this->name);
    }


}

?>