<?php
    function _log($v)
    {
        echo "<pre>";
        print_r($v);
        echo "</pre>";
    }
    function model(&$page)
    {
        if( isset($page) && is_array($page) && file_exists(APP_PATH."/model/{$page['name']}.php") ) {
            ob_start();
            require APP_PATH."/model/{$page['name']}.php";
            ob_end_flush();
            return true;
        }
        return false;
    }
    function view(&$page)
    {
        if( isset($page) && is_array($page) && file_exists(APP_PATH."/view/{$page['name']}.php") ) {
            ob_start();
            require APP_PATH."/view/{$page['name']}.php";
            ob_end_flush();
            return true;
        }
        return false;
    }
?>