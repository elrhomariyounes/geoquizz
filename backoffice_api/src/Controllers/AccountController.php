<?php


namespace gq\backoffice\Controllers;
use gq\backoffice\Helpers\JWTCreator;
use gq\backoffice\Helpers\Response\ResponseWrapper;
use gq\backoffice\Models\Responses\ErrorResponse;
use gq\backoffice\Models\Responses\ResourceResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\backoffice\Models\User;
use Ramsey\Uuid\Uuid;

class AccountController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
    }

    public function Register(Request $rq, Response $rs){
        if($rq->getAttribute('has_errors')){
            $error = new ErrorResponse("error",422,$rq->getAttribute('errors'));
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
        $body = $rq->getParsedBody();
        $user = new User();
        $user->id=Uuid::uuid4();
        $user->name=filter_var($body['name'],FILTER_SANITIZE_STRING);
        $user->mail=filter_var($body['email'],FILTER_SANITIZE_EMAIL);
        $user->password=password_hash($body['password'],PASSWORD_DEFAULT);
        try {
            $user->saveOrFail();
            $rs = ResponseWrapper::createdResponse(new ResourceResponse("resource",201,$user),$rs);
            return $rs;
        }catch (\Exception $ex){
            $error = new ErrorResponse("error",500,$ex->getMessage());
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }

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
            $token = JWTCreator::createToken($key,$user->id);
            $rs=$rs->withStatus(200)->withHeader('Content-type', 'application/json');
            $rs->getBody()->write(json_encode(['token'=>$token]));
            return $rs;

        }catch (ModelNotFoundException $ex){
            $error = new ErrorResponse("error",500,$ex->getMessage());
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }
}