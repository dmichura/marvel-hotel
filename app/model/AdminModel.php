<?php
class AdminModel implements Model {
    public function __construct(&$page)
    {   
        // _log($page);
        if( isset($page['params']['mode']) )
        {
            if ($page['params']['mode'] == "users" && isset($page['params']['func'])) {
                if( $page['params']['func'] == "show" ) {
                    $users = $page['db']->query("SELECT a.id, a.username, a.email, a.register_time, a.role_id, r.role_name FROM account a JOIN role r ON a.role_id = r.role_id ORDER BY a.id");
                    $page['data'] = array(
                        "users" => $users,
                    );
                }
            }
            elseif ($page['params']['mode'] == "rooms" && isset($page['params']['func'])){
                if( $page['params']['func'] == "show" ) {
                    $rooms = $page['db']->query("SELECT * FROM room ORDER BY id");
                    $page['data'] = array(
                        "rooms" => $rooms
                    );
                }
            }
            elseif ($page['params']['mode'] == "tickets"){

                    $tickets = $page['db']->query("SELECT `id`, `title`, `email`, `reason`, `status`, `created` FROM `ticket` ORDER BY id");
                    // _log($tickets);
                    $page['data'] = array(
                        "tickets" => $tickets
                    );
                
            }

            elseif($page['params']['mode'] == "reservations") {
                $rooms = $page['db']->query("SELECT * FROM room ORDER BY id");
                $reservations = array();
                $reservationsR = $page['db']->query("SELECT r.id, r.room_id, r.account_id, r.start_time, r.end_time, a.username, a.email FROM reservation r JOIN account a ON r.account_id = a.id;");
                foreach ($reservationsR as  $r) {
                    // var_dump( isset($reservations[$r['id']]) );
                    if(!isset($reservations[$r['id']]))
                    {
                        $reservations[$r['id']] = array();
                    }

                    $startDate = explode("-", $r['start_time']);
                    $endDate = explode("-", $r['end_time']);
                    $startTimestamp = mktime(0, 0, 0, intval($startDate[1]), intval($startDate[2]), intval($startDate[0]));
                    $endTimestamp = mktime(0, 0, 0, intval($endDate[1]), intval($endDate[2]), intval($endDate[0]));
                    $days = ceil((intval($endTimestamp) - intval($startTimestamp)) / 86400) + 1;

                    if( $days ){
                        for ($j=0; $j < $days; $j++) { 
                            $date = date("j-n-Y", $startTimestamp + ($j * 86400));
                            $reservations[$r['room_id']][$date] = array(
                                "username" => $r['username'],
                                "email" => $r['email'],
                            );
                        }
                    }
                }
                $page['data'] = array(
                    "rooms" => $rooms,
                    "month" =>  intval( ( isset($page['params']['month']) && $page['params']['month'] != "" && intval($page['params']['month']) >= 1 && intval($page['params']['month']) <= 12 ) ? intval($page['params']['month']) : date("n") ),
                    "year" => intval(( isset($page['params']['year']) && intval($page['params']['year']) >= 2000) ? intval($page['params']['year']) : date("Y")),
                    "reservations" => $reservations,
                    "months" => array(
                        "Styczeń",
                        "Luty",
                        "Marzec",
                        "Kwiecień",
                        "Maj",
                        "Czerwiec",
                        "Lipiec",
                        "Sierpień",
                        "Wrzesień",
                        "Październik",
                        "Listopad",
                        "Grudzień"
                    ),
                );
            }

        }

    }
}
?>