<?php
class RoomModel implements Model {
    public function __construct(&$page)
    {
        $page['data'] = ['test2'];
    }
}
?>