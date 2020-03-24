<?php


namespace gq\backoffice\Middlewares;
use gq\backoffice\Models\Responses\ErrorResponse;
use gq\backoffice\Helpers\Response\ResponseWrapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class CorsMiddleware extends AbstractMiddleware
{
    public function __invoke(Request $rq, Response $rs, $next)
    {
        //No Origin Header
        if(!$this->OriginIsSet($rq)){
            $error = new ErrorResponse("error",403,"No Origin Header !!");
            return ResponseWrapper::errorResponse($error,$rs);
        }
        $origin = $rq->getHeaderLine('Origin');
        $rq = $rq->withAttribute('origin',$origin);
        $response = $next($rq, $rs);
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }

    private function OriginIsSet(Request $rq){
        return count($rq->getHeader('Origin'))!=0;
    }
}