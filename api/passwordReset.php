<?php
    require "../vendor/autoload.php";

    use controller\AuthController;
    use controller\Header;
    $header = new Header();
    $header->header();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $authController = new AuthController();
        $authController->authCheck();
        $json_data = json_decode(file_get_contents("php://input"));
        $userData = $authController->getUserId();
        $inputData = (array)$json_data;
        echo json_encode($authController->reset($inputData, (int)$userData->id));
    }else{
        echo "Requested ". $_SERVER['REQUEST_METHOD']  . " Is Not Allowed";
    }