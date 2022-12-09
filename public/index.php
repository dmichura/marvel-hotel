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

    $app = new Application([
        ['GET', '/', function() {
            redirect('home');
        }],
        ['GET', '/home', function() {
            // redirect('home2');
        }],
        ['GET', '/404', function() {
            // redirect('home2');
            
        }],
    ]);
    // $app->addRoute( 'GET', '', function () {
    //     redirect("home");
    // });
    // $app->addRoute( 'GET', 'home', function (Request $req, Database $db) {
    //     new Home($req, $db);
    // } );
    // $app->addRoute( 'GET', 'rooms/:id', function (Request $req, Database $db) {
    //     new Rooms($req, $db);
    // } );

    // $app->addRoute('GET', '404', function(){
    //     $page = [
    //         'name' => "not_found",
    //         'title' => '404'
    //     ];
    //     view($page);
    //     new Response(404);
    // });

    // $app->addRoute( 'ALL', '*', function (Request $req, Database $db) {
    //     redirect("/404");
    // });
    $app->run();
    die();
?>