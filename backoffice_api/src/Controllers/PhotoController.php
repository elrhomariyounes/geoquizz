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

    /**
     * @OA\Put(
     *     path="/photos/{id_photo}",
     *     tags={"photo"},
     *     summary="Assign photo to a serie",
     *     description="Affectation d'une photo prise de l'application mobile à une serie",
     *     @OA\Parameter(
     *          name="photoId",
     *          in="path",
     *          description="id de la photo",
     *          required=true,
     *          @OA\Schema(type="int")
     *      ),
     *     @OA\Response(
     *         response="204",
     *         description="La photo est affecté à la serie demandé"
     *     ),
     *     @OA\RequestBody(
     *         description="",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AssignPhotoToSerie")
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/photos",
     *     tags={"photo"},
     *     summary="Add new Photo",
     *     description="Ajout d'une nouvelle photo",
     *     @OA\Response(
     *         response="201",
     *         description="Photo ajoutée",
     *          @OA\JsonContent(ref="#/components/schemas/Photo")
     *     ),
     *     @OA\RequestBody(
     *         description="",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotoViewModel")
     *     )
     * )
     */
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


    /**
     * @OA\Get(
     *     path="/users/{id_user}/photos",
     *     tags={"photo"},
     *     summary="Get users photos",
     *     description="Recuperer les photos prises depuis l'application mobile qui ne sont toujours pas affectées à une serie",
     *     @OA\Parameter(
     *          name="userId",
     *          in="path",
     *          description="id de l'utilisateur connecté",
     *          required=true,
     *          @OA\Schema(type="int")
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="List des photos",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Photo")
     *          )
     *     )
     * )
     */
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