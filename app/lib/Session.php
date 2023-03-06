<?php
//  session_set_cookie_params([
//       'lifetime' => '',
//       'path' => '/',
//       'domain' => 'YOUR_DOMAIN',
//       'secure' => true,
//       'httponly' => true,
//       'samesite' => 'YOUR_SAME_SITE_VALUE'
//   ]);

class Session {
    public function __construct()
    {
        // if($_SERVER["HTTPS"] != "on") {
        //     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        //     exit();
        // }
        session_start();
        // session_regenerate_id();
        
    }
}

?>