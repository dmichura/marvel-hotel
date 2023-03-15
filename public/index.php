

<?php
    header ('Content-Type: text/html; charset=utf-8');
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
            $res->resolve();
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
        ['POST', '/contact', function(Request $req, Response $res, $data=[]) {
            new ContactController($req, $res, $data);
        }],
        ['GET', '/room', function(Request $req, Response $res, $data=[]) {
            new RoomController($req, $res, $data);
        }],
        ['POST', '/room', function(Request $req, Response $res, $data=[]) {
            new RoomController($req, $res, $data);
        }],
        ['GET', '/rooms', function(Request $req, Response $res, $data=[]) {
            new RoomsController($req, $res, $data);
        }],
        ['GET', '/manage', function(Request $req, Response $res, $data=[]) {
            // new AccountController($req, $res, $data);
            // _log('Manage');
            new AdminController( $req, $res, $data );
        }],
        ['GET', '/account', function(Request $req, Response $res, $data=[]) {
            new AccountController($req, $res, $data);
        }],
        ['GET', '/rule', function(Request $req, Response $res, $data=[]) {
            // new AccountController($req, $res, $data);
        }],
        ['POST', '/auth', function(Request $req, Response $res, $data=[]) {
            new AuthController($req, $res, $data);
        }],
        ['GET', '/logout', function(Request $req, Response $res, $data=[]) {
            new LogoutController($req, $res, $data);
        }],
        ['GET', '/404', function(Request $req, Response $res, $data=[]) {
            new NotFoundController($req, $res, $data);
        }],
    ];

    $nav = [
        // rote, ls name, permissions
        ['home', 'homepage'],
        // ['about', 'aboutus'],
        // ['gallery', 'gallery'],
        ['contact', 'contact'],
        ['rooms', 'rooms'],
        ['account', 'log-in', [ "Unlogged" ]],
        ['account', 'my-account', [ "Admin", "User" ]],
        ['manage', 'admin-manage', [ "Admin" ]],
    ];

    $app = new Application($routes, $nav);
    $app->run();
    die();
?>