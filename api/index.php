<?php

    use config\db_connect;

    require "../vendor/autoload.php";
        $userController = new db_connect();
        var_dump($userController->connect());
