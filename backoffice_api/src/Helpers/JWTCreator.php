<?php


namespace gq\backoffice\Helpers;
use Firebase\JWT\JWT;

class JWTCreator
{
    public static function createToken($key,$obj){
        $payload = [
            'iss'=>'http://web.backoffice',
            'aud'=>'http://web.backoffice',
            'iat'=>time(),
            'exp'=>time()+3600,
            'data'=>[
                'user'=>$obj
            ]
        ];
        $token = JWT::encode($payload,$key);
        return $token;
    }
}