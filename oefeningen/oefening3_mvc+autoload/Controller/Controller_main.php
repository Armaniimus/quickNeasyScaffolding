<?php
/**
 *
 */
class Controller_main {

    function __construct() {

        $Datahandler = new Datahandler(DB_SERVER, DB, DB_USER, DB_PASS);

        $result = $Datahandler->read("SELECT * FROM tbldomainpricing LIMIT 0, 2");

        echo "<pre>";
        var_dump($result);
        echo "</pre>";
    }
}



?>
