<?php
class Router {
    private const allowedMethod = ['GET', 'POST', 'PUT', 'DELETE'];
    private $routing = [];
    private Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addRoute($method, $fpath, $callback) : bool
    {
        $fpath = explode('/', $fpath);
        $path = $fpath[0];
        $fpath = array_slice($fpath, 1);
        // _log($path);
        if ( !in_array($method, self::allowedMethod) && $method != "ALL" )
        {
            return false;
        }

        $this->routing[$method][$path] = [
            'params' => $fpath,
            'callback' => $callback
        ];
        return true;
    }

    public function resolve(Request $req, Database $db) : bool
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        if ( 
            !in_array($method, self::allowedMethod)
            || empty($this->routing[$method][$path])
        )
        {
            $method = "ALL";
            $path = "*";
        }
        _log($this->routing[$method][$path]['params']);
        // _log( $req->assignParams($this->routing[$method][$path]['params']) );
        // _log( $req->getParams() );
        call_user_func($this->routing[$method][$path]['callback'], $req, $db);
        return true;
    }

}

?>