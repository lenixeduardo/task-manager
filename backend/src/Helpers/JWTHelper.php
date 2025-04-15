<?php

namespace App\Helpers;

use \Firebase\JWT\JWT;

class JWTHelper {
 
    private static $secretKey = 'ABCD1234';

    public static function encode($data) {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; 
        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        );

        return JWT::encode($payload, self::$secretKey);
    }

    public static function decode($jwt) {
        try {
            $decoded = JWT::decode($jwt, self::$secretKey, array('HS256'));
            return (array) $decoded->data; 
        } catch (Exception $e) {
            return null; 
        }
    }
}
