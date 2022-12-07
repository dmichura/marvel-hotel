<?php

class Rooms {
    private array $page = [];
    public function __construct(Request $req, Database $db)
    {
        $this->page = [
            'name' => 'Rooms',
            'title' => 'Pokoje',
            'db' => $db,
            'req' => $req,
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