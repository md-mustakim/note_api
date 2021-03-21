<?php
    require '../vendor/autoload.php';
    use controller\UserController;
    use controller\Header;
    $header = new Header();
    $header->header();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $json_data = json_decode(file_get_contents("php://input"));
        if(!empty($json_data)){
            if(!empty($json_data->login->id) && !empty($json_data->login->pass))
            {
                 $user = new UserController();
                 $response = $user->login($json_data->login, $_SERVER['HTTP_HOST']);
                 if($response['status']){
                     http_response_code(200);
                     echo json_encode($response);
                 }else{
                     http_response_code(200);
                     echo json_encode($response);
                 }
            }else{
                echo json_encode(array('parameter missing'));
            }
        }
    }else{
        http_response_code(405);
        echo json_encode(array('Method Not allowed'));
    }
