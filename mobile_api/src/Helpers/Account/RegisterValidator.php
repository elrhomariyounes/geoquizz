<?php


namespace gq\mobile\Helpers\Account;
use Respect\Validation\Validator as v;

class RegisterValidator
{
    //TODO : delete if there is no sign up in mobile app
//    public static function RegisterValidators(){
//        return [
//            'name'=>v::stringType()->notEmpty(),
//            'email'=>v::email(),
//            'password'=>v::notEmpty()
//        ];
//    }

    public static function SignInValidators(){
        return [
            'email'=>v::email(),
            'password'=>v::notEmpty()
        ];
    }
}