<?php


namespace gq\player\Controllers;
use gq\player\Models\Difficulty;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gq\player\Helpers\Response\ResponseWrapper;
use gq\player\Models\Photo;
use gq\player\Models\Responses\ResourceResponse;
use gq\player\Models\Serie;

class SerieController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
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
    public function GetSeriesWithRandomPhoto(Request $rq, Response $rs, $args){
        $responseObject = [];
        $series = Serie::where('id','!=',0)->with('difficulty')->get();
        foreach ($series as $serie){
            $photoIds = Photo::where('serie_id','=',$serie->id)->pluck('id')->toArray();
            if($photoIds!=null){
                $randomIndex = array_rand($photoIds);
                $photo = Photo::find($photoIds[$randomIndex]);
                if(!isset($responseObject['series'])){
                    $responseObject['series'] = array();
                }
                $responseObject['series'][]=["serie"=>$serie,"photo"=>$photo];
            }
        }
        return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$responseObject),$rs);
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
}