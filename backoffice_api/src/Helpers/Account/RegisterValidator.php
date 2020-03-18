<?php


namespace gq\backoffice\Helpers\Account;
use Respect\Validation\Validator as v;

class RegisterValidator
{
    public static function RegisterValidators(){
        return [
            'name'=>v::stringType()->notEmpty(),
            'email'=>v::email(),
            'password'=>v::notEmpty()
        ];
    }

    public static function SignInValidators(){
        return [
            'email'=>v::email(),
            'password'=>v::notEmpty()
        ];
    }
}