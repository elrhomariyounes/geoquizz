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
     * @OA\Get(
     *     path="/series/{id_serie}",
     *     tags={"serie"},
     *     summary="Get Serie by ID",
     *     description="Recuperer la serie par identifiant",
     *     @OA\Parameter(
     *          name="serieId",
     *          in="path",
     *          description="id de la serie",
     *          required=true,
     *          @OA\Schema(type="int")
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Aucune serie avec cette identifiant"
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Serie",
     *          @OA\JsonContent(ref="#/components/schemas/Serie")
     *     )
     * )
     */
    public function GetSerieById(Request $rq, Response $rs, $args){
        if(isset($args['id'])){
            $serie=Serie::find($args['id']);
            if($serie!=null){
                return ResponseWrapper::collectionResponse(new ResourceResponse("resource",200,$serie),$rs);
            }
            return ResponseWrapper::errorResponse(new ErrorResponse("error",404,"No serie found with the id : ".$args['id']),$rs);
        }
    }

    /**
     * @OA\Post(
     *     path="/series",
     *     tags={"serie"},
     *     summary="Add new Serie",
     *     description="Ajout d'une nouvelle serie",
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
        $serie->map_refs=filter_var($body['map_refs'],FILTER_SANITIZE_STRING);
        $serie->difficulty_id= filter_var($body['difficultyId'],FILTER_SANITIZE_NUMBER_INT);
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