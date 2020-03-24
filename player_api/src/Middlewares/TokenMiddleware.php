<?php


namespace gq\player\Middlewares;
use gq\player\Models\Game;
use gq\player\Models\Responses\ErrorResponse;
use gq\player\Helpers\Response\ResponseWrapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TokenMiddleware extends AbstractMiddleware
{
    public function __invoke(Request $rq, Response $rs, $next){
        $tokenParam = $rq->getQueryParams('token',"");
        if(count($tokenParam)==0){
            $error = new ErrorResponse("error",401,"No Token provided !!");
            return ResponseWrapper::errorResponse($error,$rs);
        }
        $id = $rq->getAttribute('route')->getArgument('id');
        $game = Game::where('id','=',$id)->where('token','=',$tokenParam)->first();
        if($game==null){
            $error = new ErrorResponse("error",401,"Unauthorized Action");
            return ResponseWrapper::errorResponse($error,$rs);
        }
        return $next($rq,$rs);
    }
}