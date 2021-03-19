<?php
    namespace config;
    require "../vendor/autoload.php";
    use PDO;
    use PDOException;


    class db_connect{

        public function connect()
        {
            try {
                return new PDO("mysql:host=".HOST.";dbname=".DB, DB_USER, DB_PASS);
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