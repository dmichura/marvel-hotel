<?php

    // headers
    header('Content-Type: text/html; charset=UTF-8');

    define( "APP_PATH", dirname(__FILE__) ."/../../app" );
    define( "PUBLIC_PATH", dirname(__FILE__) ."/../../public" );

    require APP_PATH.'/../config/config.php';
    require APP_PATH.'/inc/utils.php';
?>