<?php
    namespace controller;
    use Exception;
    use Firebase\JWT\JWT;
    use model\User;

    class AuthController{

        /**
         * Get header Authorization
         * */
        function getAuthorizationHeader(): ?string
        {
            $headers = null;
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER["Authorization"]);
            }
            else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
                $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
                //print_r($requestHeaders);
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;
        }
        /**
         * get access token from header
         * */
        function getBearerToken() {
            $headers = $this->getAuthorizationHeader();
            // HEADER: Get the access token from the header
            if (!empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                    return $matches[1];
                }
            }
            return null;
        }

        private function tokenDecode(bool $getId = false): array
        {
            try{
                $userData = JWT::decode($this->getBearerToken(), JWT_KEY, array('HS256'));
                if ($getId){
                    return array(
                        'status' => true,
                        'userData' => $userData
                    );
                }else

                return array(
                    'status' => true
                );

            }catch(Exception $e)
            {
                return array(
                    'status' => false,
                    'error' => $e->getMessage(),
                );
            }
        }

        public function getUserId(): object{
            $userData = $this->tokenDecode(true);
            return $userData['userData']->userData;
        }

        public function authCheck() {
            $token = $this->getBearerToken();
            if($token === null){
                http_response_code(401);
                echo json_encode(array('status' => false, 'message' => 'Bearer Token Required'));
                exit();
            }else{
               if (!$this->tokenDecode()['status']){
                   http_response_code(401);
                   echo json_encode($this->tokenDecode());
                   exit();
               }
            }
        }

        public function verifyPassword(int $userId, $plainPassword): array
        {
            $userModel = new User();
            $userData = $userModel->show($userId);
            if ($userData['status']){
                $hashPassword = $userData['data']['pass'];
                if (password_verify($plainPassword, $hashPassword)){
                    return array(
                        'status' => true
                    );
                }else{
                    return array(
                        'status' => false,
                        'error' => 'Old Password does not match'
                    );
                }
            }else{
                return array(
                    'status' => false,
                    'error' => 'User Not Found'
                );
            }
        }

        public function reset(array $values, int $userId): array
        {
            if (isset($values['old_password']) && isset($values['new_password']) && isset($values['confirm_password'])){
                if ($values['new_password'] == $values['confirm_password']){
                    $new_password = $values['new_password'];
                    $auth = new User();
                    $passwordVerify =$this->verifyPassword($userId,$values['old_password']);
                    if ($passwordVerify['status']){
                        $resetStatus = $auth->passwordReset([password_hash($new_password, PASSWORD_DEFAULT), $userId]);
                        if ($resetStatus['status']){
                         return array(
                             'status' => true,
                             'message' => 'Password Change Success'
                         );
                        }else{
                            return array(
                                'status' => false,
                                'error' => $resetStatus['error']
                            );
                        }

                    }else{
                        return array(
                            'status' => false,
                            'error' => $passwordVerify['error']

                        );
                    }

                }else{
                    return array(
                        'status' => false,
                        'error' => 'Password Confirm failed'
                    );
                }
            }else{
                return array(
                    'status' => false,
                    'error' => 'We can not found array perfectly',
                    'response' => $values
                );
            }
        }
    }