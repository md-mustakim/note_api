<?php
    require "../vendor/autoload.php";

    use controller\AuthController;
    use controller\Header;

    $h = new Header();
    $h->header();

    $auth = new AuthController();
    $auth->authCheck();
    echo json_encode($auth->getUserId());