<?php
class RoomsModel implements Model {
    public function __construct(&$page)
    {
        $result = $page['db']->query("SELECT * FROM room");
        $page['data'] = array(
            "rooms" => $result
        );
    }
}
?>