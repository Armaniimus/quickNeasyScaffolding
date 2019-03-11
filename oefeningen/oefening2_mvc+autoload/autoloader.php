<?php
    spl_autoload_register(function($class) {
        if (file_exists("$class.php")) {
            require_once "$class.php";

        } else if (file_exists("Model/$class.php")) {
            require_once "Model/$class.php";

        } else if (file_exists("Controller/$class.php")) {
            require_once "Controller/$class.php";
        }
    });
?>
