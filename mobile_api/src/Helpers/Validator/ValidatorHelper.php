<?php


namespace gq\mobile\Helpers\Validator;
use Respect\Validation\Validator as v;

class ValidatorHelper
{

    public static function SignInValidators(){
        return [
            'email'=>v::email(),
            'password'=>v::notEmpty()
        ];
    }

    public static function PhotoValidators(){
        return [
            'description'=>v::stringType()->notEmpty(),
            'url'=>v::url(),
            'lng'=>v::numeric(),
            'lat'=>v::numeric(),
            'userId'=>v::stringType()->notEmpty(),
            'serieId'=>v::optional(v::numeric())
        ];
    }

    public static function SerieValidators(){
        return [
            'city'=>v::stringType()->notEmpty(),
            'difficultyId'=>v::numeric()
        ];
    }
}