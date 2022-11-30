<?php
    require "../app/inc/bootstrap.php";

    // $app = new Application();

    // // home
    // $app->router->addRoute( 'GET', '/', function ($db) {
    //     new HomeController($db);
    // } );

    // // 404
    // $app->router->addRoute( '*', '*', function () {
    //     view('404');
    // } );
    // $app->handle();

    spl_autoload_register(function ($file) {
        if( file_exists(APP_PATH."/lib/$file.php") ) {
            require APP_PATH."/lib/$file.php";
        }
        else if( file_exists(APP_PATH."/controller/$file.php") ) {
            require APP_PATH."/controller/$file.php";
        }
    });

    // echo "<pre>";
    // print_r( $_SERVER );
    // echo "</pre>";

    $app = new Application();
    $app->addRoute( 'GET', '/', function () {
        new HomeController();
    } );

    die();
?>