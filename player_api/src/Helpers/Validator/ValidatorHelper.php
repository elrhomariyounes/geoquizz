<?php


namespace gq\player\Helpers\Validator;
use Respect\Validation\Validator as v;

class ValidatorHelper
{
    public static function GameValidators(){
        return [
            'player'=>v::stringType()->notEmpty(),
            'serieId'=>v::numeric(),
        ];
    }

}