<?php
Require_once "config.php";
Require_once "autoloader.php";

new Main_controller('success');

// $Datahandler = new DatahandlerOriginal();
$Datahandler = new Datahandler();

$sql = 'INSERT INTO test (t1) VALUES ("newtest 5")';
$Datahandler->create($sql);

echo '<br><pre>';
$sql = 'SELECT * FROM test';
var_dump($Datahandler->read($sql) );
echo '</pre>';

?>
