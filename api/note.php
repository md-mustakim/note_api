<?php
    require "../vendor/autoload.php";

    use controller\AuthController;
    use controller\Header;
    use controller\NoteController;

    $header = new Header();
    $header->header();
    $auth = new AuthController();
    $auth->authCheck();
    $userId = $auth->getUserId()->id;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $jsom_data = json_decode(file_get_contents("php://input"));
        if(!empty($jsom_data)){
            $noteController = new NoteController();
            echo json_encode($noteController->create($jsom_data, $userId));
        }else{
            echo json_encode(array(
                'status' => false,
                'message' => 'Empty Body'
            ));
        }
    }else{
        if(isset($_GET['view'])){
            $noteController = new NoteController();
            echo json_encode($noteController->view());
        }
        if(isset($_GET['showByCategory']) && isset($_GET['categoryId'])){
            $noteController = new NoteController();
            $id = (int)$_GET['categoryId'];
            echo json_encode($noteController->showByCategory($id));
        }
        if(isset($_GET['show']) && isset($_GET['id'])){
            $noteController = new NoteController();
            echo json_encode($noteController->show($_GET['id']));
        }
        if(isset($_GET['delete']) && isset($_GET['id'])){
            $noteController = new NoteController();
            echo json_encode($noteController->delete($_GET['id']));
        }



    }