<?php
    require "../app/inc/bootstrap.php";
    // autoload
    spl_autoload_register(function ($file) {
        if( file_exists(APP_PATH."/lib/$file.php") ) {
            require APP_PATH."/lib/$file.php";
        }
        else if( file_exists(APP_PATH."/controller/$file.php") ) {
            require APP_PATH."/controller/$file.php";
        }
    });
    $app = new Application();
    $app->addRoute( 'GET', '/', function (Database $db) {
        new Home($db);
    } );
    $app->addRoute( 'GET', '/home', function (Database $db) {
        new Home($db);
    } );

    $app->run();
    die();
?>