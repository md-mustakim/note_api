<?php
    require "../vendor/autoload.php";

    use Controller\Header;
    use Controller\NoteController;

    $header = new Header();
    $header->header();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $jsom_data = json_decode("php://input");
        if(!empty($jsom_data)){
            $noteController = new NoteController();
            echo json_encode($noteController->create($jsom_data));
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
        if(isset($_GET['show']) && isset($_GET['id'])){
            $noteController = new NoteController();
            echo json_encode($noteController->show($_GET['id']));
        }

    }