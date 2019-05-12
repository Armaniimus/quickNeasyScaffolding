<?php
    require_once "config.php";
    require_once "autoload.php";

    // $main = new Controller_Main();
    $Router = new Router(ROOT);
    echo $Router->run();
?>
