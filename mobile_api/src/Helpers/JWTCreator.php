<?php


namespace gq\mobile\Helpers;
use Firebase\JWT\JWT;

class JWTCreator
{
    public static function createToken($key,$obj){
        $payload = [
            'iss'=>'http://geoquizz.mobile',
            'aud'=>'http://geoquizz.mobile',
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