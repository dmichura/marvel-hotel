<?php

class Calendar {
    private $year;
    private $month;
    private $reservations = [];
    private $months = array(
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
    );
    public function __construct($year, $month, $reservations=[])
    {
        $this->year = intval( ($year != false) ? $year : date("Y") );
        $this->month = intval( ($month != false) ? $month : date("n") );
        $this->reservations = self::getReservations($reservations);
        // _log($reservations);

    }


    public function getMonth(){
        return $this->month;
    }

    public function getMonthName(){
        return $this->months[$this->month - 1];
    }
    public function getYear(){
        return $this->year;
    }

    public function getAllDayNumber() {
        $n = cal_days_in_month(CAL_GREGORIAN,$this->month,$this->year);
        return $n;
    }

    public function getReservationDay()
    {

    }

    public function showDays() {
        $html = "";

        for ($i=1; $i <= $this->getAllDayNumber(); $i++) { 
            $classHired = '';
            // if($this->reservations[])
            // var_dump("$i-{$this->getMonth()}-{$this->getYear()}");
            // var_dump(isset($this->reservations["$i-{$this->getMonth()}-{$this->getYear()}"]));
            if( isset($this->reservations["$i-{$this->getMonth()}-{$this->getYear()}"]) ) $classHired = " hired";
            $html .= "<div class='day$classHired'>$i</div>";
        }

        return $html;
    }


    public static function getReservations($reservations) {
        $arr = [];
        if( isset($reservations) && gettype($reservations) == "array" && count($reservations) > 0 ) {
            foreach($reservations as $reservation) {
                // _log($reservation);
                $start = $reservation['start_time'];
                $end = $reservation['end_time'];
                $days = Calendar::getDaysBetween($end, $start);
                // _log($days);
                if ($days) {
                    for ($j=0; $j < $days; $j++) { 
                        $date = date("j-n-Y", $start + ($j * 86400));
                        // _log($date);
                        $arr[$date] = true;
                    }
                }
            }
        }
        // _log($arr);
        return $arr;
    }

    public static function getDaysBetween($end, $start)
    {
        return ceil((intval($end) - intval($start)) / 86400) + 1;
    }

    public static function checkReservation($reservation, $start, $end) {
        // _log($reservation);
        // _log($start);
        // _log($end);

        $reservations = self::getReservations($reservation);
        // _log($reservations);
        $startDate = explode("-", $start);
        $endDate = explode("-", $end);
        $startTimestamp = mktime(0, 0, 0, intval($startDate[1]), intval($startDate[2]), intval($startDate[0]));
        $endTimestamp = mktime(0, 0, 0, intval($endDate[1]), intval($endDate[2]), intval($endDate[0]));
        $days = self::getDaysBetween( $endTimestamp, $startTimestamp );
        // _log($days);
        $bool = true;
        if( $days )
        {
            for ($j=0; $j < $days; $j++) { 
                $date = date("j-n-Y", $startTimestamp + ($j * 86400));
                _log($date);
                // _log($j." ".$date);
                if(isset($reservations[$date]))
                {
                    $bool = false;
                    break;
                }
                // $reservations[$date] = true;
            }
        }
        return $bool;
    }
}

class RoomModel implements Model {
    public function __construct(&$page)
    {
        if( $page['method'] == "GET" ){
            $result = $page['db']->query("SELECT * FROM room WHERE id = {$page['data']['id']}");
            $result2 = $page['db']->query("SELECT id, room_id, account_id, UNIX_TIMESTAMP(start_time) as start_time, UNIX_TIMESTAMP(end_time) as end_time FROM `reservation` WHERE room_id = {$page['data']['id']}");
            
            $calendar = new Calendar($page['data']['year'], $page['data']['month'], $result2);
            $page['data'] = array(
                "room" => $result[0],
                "year" => $page['data']['year'],
                "month" => $page['data']['month'],
                "reservations" => $result2,
                "calendar" => $calendar
            );
        }
        else if( $page['method'] == "POST" ) {
            // echo $page['data']['id'];
            $reservations = $page['db']->query("SELECT id, room_id, account_id, UNIX_TIMESTAMP(start_time) as start_time, UNIX_TIMESTAMP(end_time) as end_time FROM `reservation` WHERE room_id = {$page['data']['id']}");
            $createBool = false;
            if ($_POST['end'] >=  $_POST['start']) {
                // _log('ds');
                if ( Calendar::checkReservation($reservations, $_POST['start'], $_POST['end']) ) {
                    // _log("Możesz");
                    $createBool = true;
                }
            }

            $page['data'] = array(
                "create" => $createBool,
                "id" => $page['data']['id'],
                "account_id" => $page['user']->getID(),
                "start" => $_POST['start'],
                "end" => $_POST['end'],
            );
        }

    }
}
?>