<?php


namespace gq\backoffice\Middlewares;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\backoffice\Helpers\Response\ResponseWrapper;
use gq\backoffice\Models\Responses\ErrorResponse;
use gq\backoffice\Helpers\JWTHelper;

class TokenMiddleware extends AbstractMiddleware
{
    public function __invoke(Request $rq, Response $rs, $next){
        $key = $this->container->settings['key'];
        $header = $rq->getHeader('Authorization');
        if(count($header)==0){
            $error = new ErrorResponse("error",401,"No authorization header present !");
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
        else{
            $header = $rq->getHeaderLine('Authorization');
            $var = JWTHelper::decodeToken($key,$header);
            if(!$var['isSuccess']){
                $error = new ErrorResponse("error",505,$var['message']);
                $rs = ResponseWrapper::errorResponse($error,$rs);
                return $rs;
            }
            else{
                $parsedBody = $rq->getParsedBody();
                $id=null;
                if(isset($parsedBody['userId'])){
                    $id=$parsedBody['userId'];
                }
                else{
                    // for route get users photos
                    $idArgument = $rq->getAttribute('route')->getArgument('id');
                    if($idArgument!=null)
                        $id=$idArgument;
                }
                if($id!=null){
                    if($var['token']['data']['user']!=$id){
                        $error = new ErrorResponse("error",401,"Action Not authorized !!");
                        $rs = ResponseWrapper::errorResponse($error,$rs);
                        return $rs;
                    }
                    else{
                        return $next($rq,$rs);
                    }
                }
                $error = new ErrorResponse("error",422,"Bad Request !!");
                $rs = ResponseWrapper::errorResponse($error,$rs);
                return $rs;
            }
        }
    }
}