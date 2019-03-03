<?php
require_once "config.php";
require_once "autoloader.php";

$Datahandler = new Datahandler(DATABASE, USER, PASS);
$result =  $Datahandler->readData(
    "SELECT * FROM `products` WHERE product_name = 'chocolate';"
);
$viewMain = 'home.php';
include 'view/template.php';

$Router = new Router(ROOT);
$echo = $Router->run();
echo $echo;
?>
