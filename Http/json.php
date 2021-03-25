<?php
    namespace http;
    class json {
        public function response(int $response_code, array $array = array()){
            http_response_code($response_code);
            echo json_encode($array);
        }

    }