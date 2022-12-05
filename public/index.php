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
        redirect("home");
    });
    $app->addRoute( 'GET', '/home', function (Database $db) {
        new Home($db);
    } );

    $app->addRoute('GET', '/404', function(){
        $page = [
            'name' => "not_found",
            'title' => '404'
        ];
        view($page);
        new Response(404);
    });

    $app->addRoute( 'ALL', '*', function (Database $db) {
        redirect("404");
    });
    $app->run();
    die();
?>