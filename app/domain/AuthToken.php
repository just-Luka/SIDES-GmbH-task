<?php

namespace App\domain;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthToken
{
    /**
     * @param $jwtKey
     * @return false|object
     */
    public function decode($jwtKey)
    {
        try {
            return JWT::decode($jwtKey, new Key('123456789', 'HS256'));
        }catch (\Exception $e) {
            echo $e->getMessage();
            http_response_code(401);
            return false;
        }
    }
}