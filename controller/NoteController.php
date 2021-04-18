<?php
namespace controller;

use config\db_connect;
use model\Note;
use module\Controller\BaseController;
use PDO;

class NoteController extends BaseController {
    public PDO $connection;
    public function __construct()
    {
        $config = new db_connect();
        $this->connection = $config->connect();
    }
    public function create(Object $data, int $user_id): array{
        $noteModel = new Note();
        $inputDataArray = (array)$data;
        $validationKey = array(
            'category_id' => 'required',
            'note_data' => 'required'
        );
        if (count($inputDataArray) < 2){
            return array('status' => false, 'message' => 'Invalid Parameter');
        }else{
            $errors = array();
            foreach ($validationKey as $item => $value){
                if (!array_key_exists($item,$inputDataArray)){
                    $error = array($item => 'this field is required');
                    array_push($errors, $error);
                }else{
                    if (strlen($inputDataArray[$item]) === 0){
                        $error = array($item => $item.' can not be empty');
                        array_push($errors, $error);
                    }
                }
            }

            if (count($errors) === 0){
                $data = (array)$data;
                $inputDataArray = array(
                    $user_id, $data['category_id'], $data['note_data'], 0
                );

                return $noteModel->create($inputDataArray);
            } else{
                return array(
                    'status' => false,
                    'message' => $errors
                );
            }
        }
    }


    public function view():array{
        $noteModel = new Note();
        $viewMultipleArray = $noteModel->view();
        if ($viewMultipleArray['status']){
            $newArray = array();
            foreach ($viewMultipleArray['data'] as $item)
            {
                $item['reg_time'] = $this->time_elapsed_string($item['reg_time']);
                array_push($newArray, $item);
            }
            return array(
                'status' => true,
                'data' => $newArray
            );
        }else{
            return $noteModel->view();
        }

    }

    public function show(int $id):array{
        $noteModel = new Note();
        $singleArray = $noteModel->show($id);


        if ($singleArray['status'] === true){
            $oldTime = $singleArray['data']['reg_time'];
            $newTime = $this->time_elapsed_string($oldTime);
            $replaceItem = array('reg_time' => $newTime);
            return array(
                'status' => true,
                'data' => array_replace($singleArray['data'], $replaceItem)
            );
        }else{
            return array(
                'status' => false,
            );
        }
    }
    public function showByCategory(int $categoryId):array{
        $noteModel = new Note();
        $categoryModel = new CategoryController();
        $singleCategoryById = $categoryModel->show($categoryId);
        $noteData = $noteModel->showByCategory($categoryId);
        if ($noteData['status'])
        {
            $dataItem = array();
            foreach ($noteData['data'] as $item){
                $item['time'] = $item['reg_time'];
                $item['reg_time'] = $this->time_elapsed_string($item['reg_time']);
                array_push($dataItem, $item);
            }
            return array(
                'status' => true,
                'category_name' => $singleCategoryById,
                'note_data' => array(
                    'status' => true,
                    'data' => $dataItem
                )
            );
        }else{
            return array(
                'status' => false,
                'category_name' => $singleCategoryById,
                'note_data' => $noteData
            );
        }




    }

    public function delete(int $id):array{
        $noteModel = new Note();
        return $noteModel->delete($id);
    }











}