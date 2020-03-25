<?php


namespace gq\backoffice\Controllers;
use gq\backoffice\Models\Photo;
use gq\backoffice\Models\Serie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\backoffice\Helpers\Response\ResponseWrapper;
use gq\backoffice\Models\Responses\ErrorResponse;
use gq\backoffice\Models\Responses\ResourceResponse;
class PhotoController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
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

    public function AddPhoto(Request $rq, Response $rs){
        if($rq->getAttribute('has_errors')){
            $error = new ErrorResponse("error",422,$rq->getAttribute('errors'));
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
        $parsedBody = $rq->getParsedBody();
        $photo = new Photo();
        $photo->description = filter_var($parsedBody['description'],FILTER_SANITIZE_STRING);
        $photo->url = filter_var($parsedBody['url'],FILTER_SANITIZE_STRING);
        $photo->position = "[".$parsedBody['lat'].",".$parsedBody['lng']."]";
        $photo->serie_id = filter_var($parsedBody['serieId'],FILTER_SANITIZE_NUMBER_INT);
        $photo->user_id=filter_var($parsedBody['userId'],FILTER_SANITIZE_STRING);
        try {
            $photo->saveOrFail();
            $rs = ResponseWrapper::createdResponse(new ResourceResponse("resource",201,$photo),$rs);
            return $rs;
        }catch (\Exception $ex){
            $error = new ErrorResponse("error",505,$ex->getMessage());
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }

    public function GetPhotosByUser(Request $rq, Response $rs, $args){
        if(isset($args['id'])){
            $photos = Photo::where('user_id','=',$args['id'])->whereNull('serie_id')->get();
            if(count($photos)){
                $rs = ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$photos),$rs);
                return $rs;
            }
            $error = new ErrorResponse("error",404,"All photos are assigned to a serie");
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }
}