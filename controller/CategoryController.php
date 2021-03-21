<?php
    namespace controller;
    use model\Category;


    class CategoryController{
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

        public function view(): array{
            $categoryModel = new Category();
            return $categoryModel->view();
        }
        public function delete(int $id): array{
            $categoryModel = new Category();
            return $categoryModel->delete($id);
        }
    }