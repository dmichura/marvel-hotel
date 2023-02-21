<?php
 session_set_cookie_params([
      'lifetime' => 'YOUR_LIFE_TIME_VALUE',
      'path' => '/',
      'domain' => 'YOUR_DOMAIN',
      'secure' => true, // set it true for secure
      'httponly' => true, // set it true for secure
      'samesite' => 'YOUR_SAME_SITE_VALUE'
  ]);

class Session {
    public function __construct()
    {
        // if($_SERVER["HTTPS"] != "on") {
        //     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        //     exit();
        // }
    }
}

?>