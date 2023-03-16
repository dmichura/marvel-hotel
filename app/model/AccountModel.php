<?php
class AccountModel implements Model {
    public function __construct(&$page)
    {
        if($page['user']->isLogged())
        {
            if ( isset( $page['params']['mode'] ) && $page['params']['mode'] === "showReservations" ) {
                // _log($page['user']->getID());
                ;
                $result = $page['db']->query("SELECT r.id, r.room_id, r.start_time, r.end_time, rr.name as room_name FROM reservation r JOIN room rr ON r.room_id = rr.id WHERE r.account_id =  {$page['user']->getID()};");
                $page['data']['reservations'] = $result;
                // _log($result);
            }
        }
        // $page['data'] = ['test', 'test2'];

    }
}
?>