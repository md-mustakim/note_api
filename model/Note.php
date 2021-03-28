<?php
    namespace model;
    use config\db_connect;
    use PDOException;
    use PDO;
    class Note{
        private PDO $connection;
        public function __construct()
        {
            $config = new db_connect();
            $this->connection = $config->connect();
        }

        public function create(array $values): array{
            try {
                $sql = "INSERT INTO note (user_id, category_id, note_data, change_count) VALUES (?,?,?,?)";
                $stmt = $this->connection->prepare($sql);
                $status = $stmt->execute($values);
                if($status){
                    return array('status' => true, 'message' => 'create success');
                }else{
                    return array('status' => false, 'message' => 'keyword mistake');
                }
            } catch (PDOException $PDOException) {
                return array('status' => false, 'message' => $PDOException);
            }

        }


        public function view():array{
            try {
                $sql = "SELECT * FROM note";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                return array('status' => true, 'data' => $res);
            } catch (PDOException $PDOException) {
                return array('status' => false, 'message' => $PDOException);
            }
        }
        public function show(int $id): array{
            try {
                $sql = "SELECT * FROM note where `id` =".$id;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch();
                http_response_code(201);
                return array('status' => true, 'data' => $res);
            } catch (PDOException $PDOException) {
                return array('status' => false, 'message' => $PDOException);
            }
        }
        public function showByCategory(int $categoryId): array{
            try {
                $sql = "SELECT * FROM note where `category_id` =".$categoryId;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                http_response_code(200);
                return array('status' => true, 'data' => $res, 'qu' => $sql);
            } catch (PDOException $PDOException) {
                return array('status' => false, 'message' => $PDOException);
            }
        }
        public function delete(int $id): array{
            try {
                $sql = "DELETE FROM note where `id` = ".$id;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                http_response_code(201);
                return array('status' => true, 'data' => 'Delete success');
            } catch (PDOException $PDOException) {
                return array('status' => false, 'message' => $PDOException);
            }
        }
        public function deleteByCategory(int $categoryId): array{
            try {
                $sql = "DELETE FROM note where `category_id` = ".$categoryId;
                $stmt = $this->connection->prepare($sql);
                $response = $stmt->execute();
                http_response_code(200);
                return array('status' => $response, 'data' => 'Delete success');
            } catch (PDOException $PDOException) {
                return array('status' => false, 'message' => $PDOException);
            }
        }

    }