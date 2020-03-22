<?php


namespace gq\backoffice\Controllers;
use gq\backoffice\Models\Difficulty;
use gq\backoffice\Models\Serie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\backoffice\Helpers\Response\ResponseWrapper;
use gq\backoffice\Models\Responses\ErrorResponse;
use gq\backoffice\Models\Responses\ResourceResponse;

class SerieController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
    }

    public function GetDifficulties(Request $rq, Response $rs){
        $difficulties = Difficulty::all();
        return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$difficulties),$rs);
    }

    public function GetSeries(Request $rq, Response $rs){
        $series = Serie::all();
        return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$series),$rs);
    }

    public function GetSerieById(Request $rq, Response $rs, $args){
        if(isset($args['id'])){
            $serie=Serie::find($args['id']);
            if($serie!=null){
                return ResponseWrapper::collectionResponse(new ResourceResponse("resource",200,$serie),$rs);
            }
            return ResponseWrapper::errorResponse(new ErrorResponse("error",404,"No serie found with the id : ".$args['id']),$rs);
        }
    }

    public function AddSerie(Request $rq, Response $rs){
        if($rq->getAttribute('has_errors')){
            $error = new ErrorResponse("error",422,$rq->getAttribute('errors'));
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
        $body = $rq->getParsedBody();
        $serie = new Serie();
        $serie->city=filter_var($body['city'],FILTER_SANITIZE_STRING);
        $serie->difficulty_id= filter_var($body['difficultyId'],FILTER_SANITIZE_NUMBER_INT);
        //TODO : add maps_refs attribute in sql file and database
        try {
            $serie->saveOrFail();
            $rs = ResponseWrapper::createdResponse(new ResourceResponse("resource",201,$serie),$rs);
            return $rs;
        }catch (\Exception $ex){
            $error = new ErrorResponse("error",505,$ex->getMessage());
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }
}