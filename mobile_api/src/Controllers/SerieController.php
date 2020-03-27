<?php


namespace gq\mobile\Controllers;
use gq\mobile\Models\Difficulty;
use gq\mobile\Models\Photo;
use gq\mobile\Models\Serie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\mobile\Helpers\Response\ResponseWrapper;
use gq\mobile\Models\Responses\ErrorResponse;
use gq\mobile\Models\Responses\ResourceResponse;

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
        $serie->map_refs=filter_var($body['map_refs'],FILTER_SANITIZE_STRING);
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
    public function AssignSerieToPhoto(Request $rq, Response $rs, $args){
        if(isset($args['id'])){
            $body = $rq->getParsedBody();
            if(isset($body['serieId'])){
                $photo=Photo::where('id','=',$args['id'])->first();
                if($photo!=null){
                    $photo->serie_id=filter_var($body['serieId'],FILTER_SANITIZE_NUMBER_INT);
                    try {
                        $photo->saveOrFail();
                        $rs = ResponseWrapper::collectionResponse(new ResourceResponse("resource",200,$photo),$rs);
                        return $rs;
                    }catch (\Exception $ex){
                        $error = new ErrorResponse("error",505,$ex->getMessage());
                        $rs = ResponseWrapper::errorResponse($error,$rs);
                        return $rs;
                    }
                }
                $error = new ErrorResponse("error",404,"No photo found with id ".$args['id']);
                $rs = ResponseWrapper::errorResponse($error,$rs);
                return $rs;
            }
        }
    }
}