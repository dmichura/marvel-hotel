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

    $app = new Application([
        ['GET', '/', function(Request $req, Response $res, $data=[]) {
            $res->setCode(301);
            $res->setRedirect('home');
        }],
        ['GET', '/home', function(Request $req, Response $res, $data=[]) {
            new HomeController($req, $res, $data);
        }],
        ['GET', '/rooms', function(Request $req, Response $res, $data=[]) {
            new RoomController($req, $res, $data);
        }],
        ['GET', '/404', function(Request $req, Response $res, $data=[]) {
            new NotFoundController($req, $res, $data);
        }],
    ]);
    $app->run();
    die();
?>