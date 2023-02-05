<?php
class HomeModel implements Model {
    public function __construct(&$page)
    {
        $page['data'] = ['test', 'test2'];
    }
}
?>