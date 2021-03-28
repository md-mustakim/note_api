<?php
    require "../vendor/autoload.php";

use controller\AuthController;
use controller\CategoryController;
    use controller\header;
    $header = new header();
    $header->header();
    $authController = new AuthController();
    $authController->authCheck();
    $userData = $authController->getUserId();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $json_data = json_decode(file_get_contents("php://input"));
        $categoryController = new CategoryController();

        $res = $categoryController->create($json_data);

        echo json_encode($res);
    }elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
    }

    else{
        if(isset($_GET['view'])){
            $categoryController = new CategoryController();
            echo json_encode($categoryController->view($userData->id));
        }

        if(isset($_GET['show']) && isset($_GET['id'])){
            $categoryController = new CategoryController();
            echo json_encode($categoryController->show($_GET['id']));
        }
        if(isset($_GET['delete']) && isset($_GET['id'])){
            $categoryController = new CategoryController();
            echo json_encode($categoryController->delete($_GET['id']));
        }
    }
