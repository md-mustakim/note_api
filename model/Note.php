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
                $sql = "INSERT INTO note (category_id, label, note_data, old_data, change_count) VALUES (?,?,?,?,?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($values);
                return array('status' => true, 'message' => 'create success');
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

    }