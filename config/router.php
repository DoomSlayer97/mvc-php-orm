<?php

class Router 
{
    private $_uri = array();
    private $_action = array();

    public function get($uri, $action = null, $middlewares = []) {
        $this->_uri[] = '/' . trim($uri, '/');

        if ($action != null)
            $this->_action[] = [$action, "GET", $middlewares];
    }

    public function post($uri, $action = null, $middlewares = []) {
        $this->_uri[] = '/' . trim($uri, '/');

        if ($action != null)
            $this->_action[] = [$action, "POST", $middlewares];
    }
    
    public function run() {
        $uriGet = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        foreach ($this->_uri as $key => $value) {
            if (preg_match("#^$value$#", $uriGet)) {
                $action = $this -> _action[$key];
                $this -> runAction($action[0], $action[1], $action[2]);
            }
        }
    }

    private function runAction($action, $method = "GET", $middlewares = []) {
        if ( $_SERVER["REQUEST_METHOD"] === $method ) {

            foreach( $middlewares as $middleware ) {

                $result = call_user_func($middleware);

                if ( !$result ) return;
                
            }

            if($action instanceof \Closure)
                $action();
            else {
                $params = explode('@', $action);
                $obj = new $params[0];
                $obj->{$params[1]}();
            }

        }
    }

}