<?php
    namespace model;
    use config\db_connect;
    use PDO;
    use PDOException;
    class Category{
        public PDO $connection;
        public function __construct(){
            $config = new db_connect();
            $this->connection = $config->connect();
        }
        public function create(Object $object): array
        {
            try {


                $sql = "INSERT INTO categories (category_name,old_data,change_count) VALUES (?,?,?)";
                $stmt = $this->connection->prepare($sql);
                $values = array($object->category_name, '', 0);
                $stmt->execute($values);
                return array('status' => true);
            } catch (PDOException $PDOException){
                return array('status' => false, 'error' => $PDOException);
            }
        }
        public function show(int $id): array{
            try {
                $sql = "SELECT * FROM categories where id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute(array($id));
                return $stmt->fetch();
            } catch (PDOException $PDOException) {
                return array('status' => false, 'error' => $PDOException);
            }

        }
        public function view($userId): array{
            try {
                $sql = "SELECT * FROM categories";
                $stmt = $this->connection->prepare($sql);
                 $stmt->execute();
                $res = $stmt->fetchAll();
                return array('status' => true, 'data' =>$res);
            }catch (PDOException $PDOException){
                return array('status' => false, 'error' => $PDOException);
            }

        }
        public function delete(int $id): array{
            try {
                $sql = "DELETE  FROM categories WHERE id = ".$id;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                return array('status' => true, 'data' =>'Delete Success');
            }catch (PDOException $PDOException){
                return array('status' => false, 'error' => $PDOException);
            }

        }
    }