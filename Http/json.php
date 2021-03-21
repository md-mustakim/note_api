<?php
    namespace http;
    class json {
        public function response(array $array, int $response_code){
            http_response_code($response_code);
            echo json_encode($array);
        }

    }