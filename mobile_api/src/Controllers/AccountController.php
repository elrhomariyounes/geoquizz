<?php


namespace gq\mobile\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\mobile\Helpers\JWTHelper;
use gq\mobile\Helpers\Response\ResponseWrapper;
use gq\mobile\Models\Responses\ErrorResponse;
use gq\mobile\Models\User;

class AccountController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"user"},
     *     summary="LogIn",
     *     description="Connexion de l'utilisateur",
     *     @OA\Response(
     *         response="200",
     *         description="Connexion reussi",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResponse")
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Bad credentials",
     *     ),
     *     @OA\RequestBody(
     *         description="",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginViewModel")
     *     )
     * )
     */
    public function Login(Request $rq, Response $rs){
        if($rq->getAttribute('has_errors')){
            $error = new ErrorResponse("error",422,$rq->getAttribute('errors'));
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
        $body = $rq->getParsedBody();
        try {
            $user = User::select('id','name','password')->where('mail','=',$body['email'])->firstOrFail();
            if(!password_verify($body['password'],$user->password)){
                $error = new ErrorResponse("error",401,"Credentials invalid !!");
                $rs = ResponseWrapper::errorResponse($error,$rs);
                return $rs;
            }
            $key = $this->_container->settings['key'];
            $token = JWTHelper::createToken($key,$user->id);
            $rs=$rs->withStatus(200)->withHeader('Content-type', 'application/json');
            $responseObject = [
              "token"=>$token,
              "user"=>[
                  "id"=>$user->id
              ]
            ];
            $rs->getBody()->write(json_encode($responseObject));
            return $rs;

        }catch (\Exception $ex){
            $error = new ErrorResponse("error",404,"No User found with this email :".$body['email']);
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }
}