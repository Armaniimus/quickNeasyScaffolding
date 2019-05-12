<?php
/**
 *
 */
class Controller_echo {

    function __construct() {

    }

    public function main($param1 = ['']) {
        return $param1[0];
    }

    public function test() {
        return 'function test works';
    }
}



?>
