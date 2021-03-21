<?php
    namespace model;
    use config\db_connect;
    use PDO;

    require "../vendor/autoload.php";
    class User{
        public PDO $connection;
        public function __construct()
        {
            $config = new db_connect();
            $this->connection = $config->connect();
        }

        public function create($data): bool
        {
            $sql = "INSERT INTO `users`(`user`, `pass`, `email`) VALUES (?,?,?)";
            $stmt = $this->connection->prepare($sql);
            $values = array(
                $data->user,
                password_hash($data->pass, PASSWORD_DEFAULT),
                $data->email
            );
            return $stmt->execute($values);
        }

        public function login($data): array {
            $sql = "SELECT * FROM `users` where `email` LIKE '$data->id' OR `user` LIKE '$data->id'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $searchResult = $stmt->fetch();
            $count = $stmt->rowCount();

            if($count === 0){
                return array(
                    'status' => false,
                    'message' => 'No User Found',
                    'sql' => $sql
                );
            }else{
                $db_pass = $searchResult['pass'];
                if(password_verify($data->pass,$db_pass)){
                    return array(
                        'status' => true,
                        'data' => $searchResult
                    );
                }else{
                    return array(
                        'status' => false,
                        'message' => 'password does not match'
                    );
                }
            }


        }
    }


