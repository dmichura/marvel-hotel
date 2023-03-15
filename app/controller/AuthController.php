<?php

class AuthController implements Controller {
    private Request $req;
    private Response $res;
    private array $page = [
        'title' => 'Pokoje',
        'path' => '',
        'nav' => [],
        'data' => [],
    ];
    public function __construct(Request $req, Response $res, $data)
    {

        $this->page['path'] = $req->getPath();
        $this->page['nav'] = $data['nav'];
        $this->page['db'] = $data['db'];
        $this->page['user'] = $data['user'];

        $params = $req->getParams();
        $res->setCode(200);
        $res->setRedirect("account");
        if( isset($params) && gettype($params) == "array" && count($params) > 0 ) {
            $typeRequest = ( isset($params['type']) ) ? $params['type'] : false;
            if( $typeRequest == "login" ) {
                $login = ( isset($_POST['account__login-login']) && $_POST['account__login-login'] != "" ) ? $_POST['account__login-login'] : false;
                $password = ( isset($_POST['account__login-password']) && $_POST['account__login-password'] != ""  ) ? $_POST['account__login-password'] : false;

                if ( $login && $password ) {
                    $sql = "SELECT id, role_id, role.role_name, password FROM account JOIN role USING(role_id) WHERE username = '$login'";
                    $check = $this->page['db']->query($sql);
                    _log($check);
                    if(count($check) == 1)
                    {

                        if( password_verify($password, $check[0]['password']) ){
                            $this->page['user']->login($login, $check[0]['id'], $check[0]['role_id'], $check[0]['role_name']);
                            $res->setRedirect("home");
                        }
                        else
                        {
                            $this->page['user']->message("Podane hasło jest nie poprawne!", 1);
                        }
                    }
                    else
                    {
                        $this->page['user']->message("Konto o takim loginie nie istnieje!", 1);
                    }
                }
                else
                {
                    $this->page['user']->message("Podaj login oraz hasło!", 1);
                }

            } else if( $typeRequest == "register" ) {
                $acceptedRule = ( isset($_POST['account__register-accept']) && $_POST['account__register-accept'] == "on" ) ? true : false;
                if( $acceptedRule ) {
                    // echo $acceptedRule;
                    $login = ( isset($_POST['account__register-login']) && $_POST['account__register-login'] != "" ) ? $_POST['account__register-login'] : false;
                    $email = ( isset($_POST['account__register-email']) && $_POST['account__register-email'] != ""  ) ? $_POST['account__register-email'] : false;
                    $password = ( isset($_POST['account__register-password']) && $_POST['account__register-password'] != ""  ) ? $_POST['account__register-password'] : false;
                    if ($login && $email && $password) {
                        $sql = "SELECT `id` FROM `account` WHERE username = '$login'";
                        $ar = $this->page['db']->query($sql);
                        if( count($ar) == 0 )
                        {
                            // create user
                            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                            $sql2 = "INSERT INTO `account`(`username`, `password`, `email`, `register_time`, `role_id`) VALUES ('$login', '$hashed_password', '$email', NOW(), 1)";
                            $this->page['db']->query($sql2);
                            $this->page['user']->message("Konto zostało pomyślnie utworzone! Zaloguj się!");
                        }
                        else
                        {
                            // user exist
                            $this->page['user']->message("Konto o takim loginie juz istnieje!", 1);
                        }
                    }
                    else
                    {
                        $this->page['user']->message("Podaj login, hasło oraz email!", 1);
                    }

                }
            }

            $res->resolve();
        }
        die();

    }

}

?>