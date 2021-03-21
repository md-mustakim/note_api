<?php
namespace controller;

use config\db_connect;
use model\Note;
use PDO;

class NoteController{
    public PDO $connection;
    public function __construct()
    {
        $config = new db_connect();
        $this->connection = $config->connect();
    }
    public function create(Object $data): array{
        $noteModel = new Note();
        return $noteModel->create((array)$data);
    }


    public function view():array{
        $noteModel = new Note();
        return $noteModel->view();
    }
    public function show(int $id):array{
        $noteModel = new Note();
        return $noteModel->show($id);
    }
    public function update(){

    }
    public function delete(int $id):array{
        $noteModel = new Note();
        return $noteModel->delete($id);
    }











}