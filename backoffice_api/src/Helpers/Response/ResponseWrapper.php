<?php


namespace gq\backoffice\Helpers\Response;
use gq\backoffice\Models\Responses\ErrorResponse;
use gq\backoffice\Models\Responses\ResourceResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ResponseWrapper
{
    public static function errorResponse(ErrorResponse $errorModel, Response $rs){
        $rs=$rs->withStatus($errorModel->getStatus())->withHeader("Content-Type","application/json;charset=utf-8");
        $rs->getBody()->write(json_encode($errorModel));
        return $rs;
    }

    public static function createdResponse(ResourceResponse $model, Response $rs){
        $rs=$rs->withStatus($model->getStatus())
            ->withHeader('Content-type','application/json')
            ->withAddedHeader('Location',"/users/".$model->getResult()->id);
        $rs->getBody()->write(json_encode($model));
        return $rs;
    }

}