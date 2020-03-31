<?php


namespace gq\mobile\Controllers;
use gq\mobile\Models\Photo;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\mobile\Helpers\Response\ResponseWrapper;
use gq\mobile\Models\Responses\ErrorResponse;
use gq\mobile\Models\Responses\ResourceResponse;
use gq\mobile\Models\User;

class PhotoController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
    }

    /**
     * @OA\Post(
     *     path="/photos",
     *     tags={"photo"},
     *     summary="Add new Photo",
     *     description="Ajout d'une nouvelle photo",
     *     security={{"bearerAuth": {"write:photos", "read:photos"}}},
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
        $photo->position = "[".$parsedBody['lng'].",".$parsedBody['lat']."]";
        if(isset($parsedBody['serieId']))
            $photo->serie_id = filter_var($parsedBody['serieId'],FILTER_SANITIZE_NUMBER_INT);
        else
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
     *     security={{"bearerAuth": {"write:photos", "read:photos"}}},
     *     @OA\Parameter(
     *          name="userId",
     *          in="path",
     *          description="id de l'utilisateur connecté",
     *          required=true,
     *          @OA\Schema(type="int")
     *      ),
     *     @OA\Response(
     *         response="404",
     *         description="Toutes les photos sont assignées à une serie"
     *     ),
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
            $error = new ErrorResponse("error",404,"No photos found for this user : ".$args['id']);
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }
}