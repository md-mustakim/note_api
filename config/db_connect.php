<?php
    namespace config;
    require "../vendor/autoload.php";
    use PDO;
    use PDOException;


    class db_connect{

        public function connect()
        {
            try {
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                return new PDO("mysql:host=".HOST.";dbname=".DB, DB_USER, DB_PASS, $options);
            }
            catch (PDOException $exception)
            {
                return array(
                    'status'=> false,
                    'message' => $exception->getMessage()
                );
            }
        }
    }