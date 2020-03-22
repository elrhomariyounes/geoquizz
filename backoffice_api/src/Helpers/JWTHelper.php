<?php


namespace gq\backoffice\Helpers;
use Firebase\JWT\JWT;

class JWTHelper
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

    public static function decodeToken($key,$headerToken){
        $tokenString = substr($headerToken,7);
        try {
            $decodedToken = JWT::decode($tokenString,$key,['HS256']);
            return [
                "isSuccess"=>true,
                "token"=> (new self())->toArray($decodedToken)
            ];
        }catch (\Exception $ex){
            return [
                "isSuccess"=>false,
                "message"=>$ex->getMessage()
            ];
        }
    }
    private function toArray($obj){
        $var = json_encode($obj);
        return json_decode($var,true);
    }
}