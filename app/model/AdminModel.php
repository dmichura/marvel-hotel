<?php
class AdminModel implements Model {
    public function __construct(&$page)
    {
        $users = $page['db']->query("SELECT * FROM account JOIN role USING(role_id)");
        $rooms = $page['db']->query("SELECT * FROM room");
        $page['data'] = array(
            "users" => $users,
            "rooms" => $rooms
        );
    }
}
?>