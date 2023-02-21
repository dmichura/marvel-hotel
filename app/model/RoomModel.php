<?php
class RoomModel implements Model {
    public function __construct(&$page)
    {
        // echo $page['data']['id'];
        $result = $page['db']->query("SELECT * FROM room WHERE id = {$page['data']['id']}");
        $page['data'] = array(
            "room" => $result[0]
        );
    }
}
?>