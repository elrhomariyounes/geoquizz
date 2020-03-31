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

    /**
     * @OA\Get(
     *     path="/difficulties",
     *     tags={"serie"},
     *     summary="Get all difficulties",
     *     description="Recuperer les difficultés",
     *     @OA\Response(
     *         response="200",
     *         description="List des difficultés",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Difficulty")
     *          )
     *     )
     * )
     */
    public function GetDifficulties(Request $rq, Response $rs){
        $difficulties = Difficulty::all();
        return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$difficulties),$rs);
    }

    /**
     * @OA\Get(
     *     path="/series",
     *     tags={"serie"},
     *     summary="Get all series",
     *     description="Recuperer les series",
     *     @OA\Response(
     *         response="200",
     *         description="List des series",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Serie")
     *          )
     *     )
     * )
     */
    public function GetSeries(Request $rq, Response $rs){
        $series = Serie::all();
        return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$series),$rs);
    }

    /**
     * @OA\Post(
     *     path="/series",
     *     tags={"serie"},
     *     summary="Add new Serie",
     *     description="Ajout d'une nouvelle serie",
     *     security={{"bearerAuth": {"write:photos", "read:photos"}}},
     *     @OA\Response(
     *         response="201",
     *         description="Serie ajoutée",
     *          @OA\JsonContent(ref="#/components/schemas/Serie")
     *     ),
     *     @OA\RequestBody(
     *         description="",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SerieViewModel")
     *     )
     * )
     */
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
}