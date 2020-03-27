<?php


namespace gq\player\Middlewares;
use gq\player\Models\Responses\ErrorResponse;
use gq\player\Helpers\Response\ResponseWrapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class CorsMiddleware extends AbstractMiddleware
{
    public function __invoke(Request $rq, Response $rs, $next)
    {

        $origin = $rq->getHeaderLine('Origin');
        $rq = $rq->withAttribute('origin',$origin);
        $response = $next($rq, $rs);
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }

}