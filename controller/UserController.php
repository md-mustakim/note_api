<?php
    namespace controller;
    require '../vendor/autoload.php';
    use model\User;
    use Firebase\JWT\JWT;
    require "../vendor/autoload.php";
    class UserController {
        public function __construct(){

        }

        public function store($data): bool
        {

            $user = new User();
         return $user->create($data);
        }

        public function login($object, $host): array{
            $user = new User();
            $loginData = array(
                'id' => $object->id,
                'pass' => $object->pass
            );
            $response = $user->login((object)$loginData);
            if ($response['status']){
                $iss = $host; //iss host
                $iat = time();
                $nbf = $iat;
                $exp = $iat + (6 * 60 * 60);
                $aud = JWT_SECRET;


                $payload = array(
                    'iss' => $iss,
                    'iat' => $iat,
                    'nbf' => $nbf,
                    'exp' => $exp,
                    'aud' => $aud,
                    'userData' => $response['data']
                );
                $jwt = JWT::encode($payload, JWT_KEY);
                return array(
                    'status' => true,
                    'token' => $jwt
                );
            }else{
                return array(
                    'status' => false,
                    'message' => $response['message']
                );
            }


        }

    }