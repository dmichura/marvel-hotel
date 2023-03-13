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
    private $active = false;
    public function __construct()
    {
        // if($_SERVER["HTTPS"] != "on") {
        //     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        //     exit();
        // }
        session_start();
        $this->active = true;
        // session_regenerate_id();
        
    }

    public function regenerate() : bool {
        if ($this->active) {
            session_regenerate_id();
            return true;
        } else {
            return false;
        }
    }

    public function get($key) {
        // _log($key);
        if ( isset($key) && $this->active) {
            if ( isset($_SESSION[$key]) ) {
                return $_SESSION[$key];
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    }
}

?>