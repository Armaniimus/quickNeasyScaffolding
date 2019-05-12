<?php

/**
 *
 */
class Router {

    function __construct($url) {
        $offset = count( explode( '/', $url ) );
        $this->uri = explode( '/', $_SERVER['REQUEST_URI'] );
        array_splice($this->uri, 0, $offset);
    }

    public function run() {
        $this->extractUri();
        return $this->sendToDestination();
    }

    private function extractUri() {
        $uri = $this->uri;
        $this->controller   = array_shift($uri);
        $this->method       = array_shift($uri);
        $this->params       = $uri;
    }

    private function sendToDestination() {
        $ctrl = $this->controller;
        $ctrlFull = "Controller_$ctrl";
        $ctrlPath = "Controller/$ctrlFull.php";
        $method = $this->method;
        $params = $this->params;

        if ( file_exists($ctrlPath) ) {
            $controller = new $ctrlFull;
            if ( method_exists($controller, $method) ) {
                if ( isset($params[0]) && $params[0] ) {
                    return $controller->$method($params);
                } else {
                    return $controller->$method();
                }
            }
        }
        return 'FALSE';
    }
}


 ?>
