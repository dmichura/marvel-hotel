<?php

class Home {
    private array $page = [];
    public function __construct(Database $db)
    {
        $this->page = [
            'name' => 'Home',
            'title' => 'Strona główna',
            'db' => $db,
            'body' => [],
        ];
        // model
        model($this->page);
        //view
        view($this->page);

        // response
        new Response(200);
    }


}

?>