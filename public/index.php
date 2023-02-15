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
        else if( file_exists(APP_PATH."/model/$file.php") ) {
            require APP_PATH."/model/$file.php";
        }
        else if( file_exists(APP_PATH."/view/$file.php") ) {
            require APP_PATH."/view/$file.php";
        }
    });

    // $nav = 

    $routes = [
        ['GET', '/', function(Request $req, Response $res, $data=[]) {
            $res->setCode(301);
            $res->setRedirect('home');
        }],
        ['GET', '/home', function(Request $req, Response $res, $data=[]) {
            new HomeController($req, $res, $data);
        }],
        ['GET', '/about', function(Request $req, Response $res, $data=[]) {
            new AboutController($req, $res, $data);
        }],
        ['GET', '/gallery', function(Request $req, Response $res, $data=[]) {
            new GalleryController($req, $res, $data);
        }],
        ['GET', '/contact', function(Request $req, Response $res, $data=[]) {
            new ContactController($req, $res, $data);
        }],
        ['GET', '/rooms', function(Request $req, Response $res, $data=[]) {
            new RoomController($req, $res, $data);
        }],
        ['GET', '/404', function(Request $req, Response $res, $data=[]) {
            new NotFoundController($req, $res, $data);
        }],
    ];

    $nav = [
        // rote, ls name
        ['home', 'homepage'],
        ['about', 'aboutus'],
        ['gallery', 'gallery'],
        ['contact', 'contact'],
        ['rooms', 'rooms'],
    ];


    $app = new Application($routes, $nav);
    $app->run();
    die();
?>