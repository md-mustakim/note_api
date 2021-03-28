<?php

use controller\Header;
use controller\UserController;

    require "../vendor/autoload.php";
    $userController = new UserController();
    $header = new Header();
    $header->header();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $json_data = json_decode(file_get_contents("php://input"));
        if(!empty($json_data)){
            if(!empty($json_data->login)){
                if(!empty($json_data->login->data->user) && !empty($json_data->login->data->pass)){



                    var_dump($userController->store($json_data->login->data));
                }else{
                    echo json_encode(array(
                        'Parameter missing'
                    ));
                }
            }

        }else{
            echo json_encode(array(
               'Empty body'
            ));
        }
    }else{
        echo $_SERVER['REQUEST_METHOD']. " not support";
    }
