<?php
    namespace controller;
    use model\Category;
    use model\Note;
    use module\Controller\BaseController;


    class CategoryController extends BaseController {
        public function __construct(){
        }
        public function validator(Object $input, Array $rule): array{
            $error= array();
            foreach ($rule as $item => $value){
                if ($value === 'required'){
                    if(empty($input->$item))
                    {
                        array_push($error, array($item => 'is required'));
                    }else{
                        if(strlen($input->$item) === 0)
                        {
                            array_push($error, array($item => 'is required'));
                        }
                    }


                }


            }
            if(count($error) === 0){
                return array('status' => true);
            }else{
                return array('status' => false, 'error' => $error);
            }

        }
        public function create(Object $object): array
        {
            $rule = array(
                'user_id' => 'required',
                'category_name' => 'required'
            );
            $isValid = $this->validator($object, $rule);
            if($isValid['status']){
                $categoryModel = new Category();
                return $categoryModel->create($object);


            }else{
                return $isValid;
            }
        }
        public function show(int $id): array{
            $categoryModel = new Category();
            return $categoryModel->show($id);
        }

        public function view(int $userId): array{
            $categoryModel = new Category();
            $categoryModelData = $categoryModel->view($userId);
            if ($categoryModelData['status']){
                $newItem = array();
                foreach ($categoryModelData['data'] as $item){
                    $item['time'] = $item['reg_time'];
                    $item['reg_time'] = $this->time_elapsed_string($item['reg_time']);
                    array_push($newItem,$item);
                }
                return array(
                    'status' => true,
                    'data' => $newItem
                );
            }else{
                return $categoryModel->view($userId);
            }

        }
        public function delete(int $id): array{
            $categoryModel = new Category();
            $noteModel = new Note();
            $noteDeleteStatus = $noteModel->deleteByCategory($id);
            if ($noteDeleteStatus['status'])
            {
                $categoryDeleteStatus = $categoryModel->delete($id);
               if ($categoryDeleteStatus['status']){
                   return array(
                       'status' => true,
                       'message' => 'Delete Success'
                   );
               }else{
                   return array(
                       'status' => true,
                       'error' => $categoryDeleteStatus['error']
                   );
               }
            }else{
                return array(
                    'status' => true,
                    'error' => $noteDeleteStatus['error']
                );
            }

        }
    }