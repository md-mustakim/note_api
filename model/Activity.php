<?php
    namespace model;
    use config\db_connect;
    use PDO;
    use PDOException;

    class Activity{
        private PDO $connection;

        public function __construct(){
            $config = new db_connect();
            $this->connection = $config->connect();
        }

        public function create(int $user_id, string $action_name, string $action_details):array{
            try {
                $values = array(
                    $user_id,
                    $action_name,
                    $action_details
                );
                $sql = "INSERT INTO activity_log(user_id, action_name, action_details) VALUES (?,?,?)";
                $stmt = $this->connection->prepare($sql);
                $response = $stmt->execute($values);
                return array(
                    'status' => $response,
                    'message' => 'create success'
                );
            }catch (PDOException $PDOException){
                return array(
                    'status' => true,
                    'message' => $PDOException
                );
            }

        }

        public function show(int $userId): array
        {
            try {
                $sql = "SELECT * FROM activity_log WHERE user_id =".$userId;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll();
                return array(
                    'status' => true,
                    'data' => $data
                );
            }catch (PDOException $PDOException){
                return array(
                    'status' => false,
                    'message' => $PDOException
                );
            }
        }
    }