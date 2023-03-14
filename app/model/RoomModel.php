<?php
class RoomModel implements Model {
    public function __construct(&$page)
    {
        // echo $page['data']['id'];
        // _log($page['data']['month']);
        $result = $page['db']->query("SELECT * FROM room WHERE id = {$page['data']['id']}");
        $result2 = $page['db']->query("SELECT id, room_id, account_id, UNIX_TIMESTAMP(start_time) as start_time, UNIX_TIMESTAMP(end_time) as end_time FROM `reservation` WHERE 1;");
        $page['data'] = array(
            "room" => $result[0],
            "year" => $page['data']['year'],
            "month" => $page['data']['month'],
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
            "reservations" => $result2
        );
    }
}
?>