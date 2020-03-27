<?php


namespace gq\player\Controllers;
use gq\mobile\Controllers\PhotoController;
use gq\player\Models\Game;
use gq\player\Models\Photo;
use gq\player\Models\Serie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use gq\player\Models\Responses\ErrorResponse;
use gq\player\Models\Responses\ResourceResponse;
use gq\player\Helpers\Response\ResponseWrapper;
class GameController
{
    private $_container;

    public function __construct($_container)
    {
        $this->_container = $_container;
    }

    public function CreateGame(Request $rq, Response $rs){
        //Check if errors
        if($rq->getAttribute('has_errors')){
            $error = new ErrorResponse("error",422,$rq->getAttribute('errors'));
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }

        //Generate a token
        $token = openssl_random_pseudo_bytes(32);
        $token = bin2hex($token);

        //Get body
        $body = $rq->getParsedBody();

        //Create the game
        $game = new Game();
        $game->id = Uuid::uuid4();
        $game->player=filter_var($body['player'],FILTER_SANITIZE_STRING);
        $game->serie_id=filter_var($body['serieId'],FILTER_SANITIZE_NUMBER_INT);
        $game->nb_photos=10;
        $game->token=$token;
        try {
            $game->saveOrFail();
            $rs = ResponseWrapper::createdResponse(new ResourceResponse("resource",201,$game),$rs);
            return $rs;
        }catch (\Exception $ex){
            $error = new ErrorResponse("error",500,$ex->getMessage());
            $rs = ResponseWrapper::errorResponse($error,$rs);
            return $rs;
        }
    }

    /**
     * Get game informations : serie difficulty
     * @param Request $rq
     * @param Response $rs
     * @param $args
     * @return Response
     */
    public function GetGameById(Request $rq, Response $rs, $args){
        if(isset($args['id'])){
            $game = Game::where('id','=',$args['id'])->with('serie')->with('serie.difficulty')->with('serie.photos')->first();
            if($game!=null){
                return ResponseWrapper::collectionResponse(new ResourceResponse("resource",200,$game),$rs);
            }
            return ResponseWrapper::errorResponse(new ErrorResponse("error",404,"No game found with the id : ".$args['id']),$rs);
        }
    }

    /*
     * Get game photos
     *
     */
    public function GetGamePhotos(Request $rq, Response $rs, $args){
        $game=Game::find($args['id']);
        $serie = Serie::find($game->serie_id);
        //Get id all photo ids
        $photoIds = Photo::where('serie_id','=',$serie->id)->pluck('id')->toArray();
        //Pick random ids from the array of the ids
        $randomIndexes = array_rand($photoIds,10);
        //Random photo ids array
        $randomPhotoIds=[];
        //Loop into the random indexes to get the random ids
        foreach ($randomIndexes as $index){
            array_push($randomPhotoIds,$photoIds[$index]);
        }
        //Pass the random ids   to where
        $photos = Photo::whereIn('id',$randomPhotoIds)->exclude(['user_id'])->get();
        if($game!=null){
            $game->state=2;
            $game->save();
            return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$photos),$rs);
        }
        return ResponseWrapper::errorResponse(new ErrorResponse("error",404,"No game found with the id : ".$args['id']),$rs);
    }

    public function FinishGame(Request $rq, Response $rs, $args){
        //Get body
        $body = $rq->getParsedBody();
        $game=Game::find($args['id']);
        if($game!=null){
            $game->score=filter_var($body['score'],FILTER_SANITIZE_NUMBER_INT);
            $game->state=3;
            try {
                $game->saveOrfail();
                return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$game),$rs);
            }catch (\Exception $ex){
                return ResponseWrapper::errorResponse(new ErrorResponse("error",500,$ex->getMessage()),$rs);
            }
        }
        return ResponseWrapper::errorResponse(new ErrorResponse("error",404,"No game found with the id : ".$args['id']),$rs);
    }

    //Get Scores
    public function GetSerieScores(Request $rq, Response $rs, $args){
        $games = Game::where('serie_id','=',$args['id'])->where('state','=',3)
                        ->orderBy('score','DESC')
                        ->exclude(['id','token','created_at','updated_at','state','nb_photos','serie_id'])
                        ->get();
        if($games->isNotEmpty()){
            return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$games),$rs);
        }
        return ResponseWrapper::errorResponse(new ErrorResponse("error",404,"No serie found with the id : ".$args['id']),$rs);
    }

    public function GetAllGamesScores(Request $rq, Response $rs, $args){
        $games = Game::where('state','=',3)->with('serie')
                        ->orderBy('score','DESC')
                        ->take(10)
                        ->exclude(['id','token','created_at','updated_at','state','nb_photos'])
                        ->get();
        return ResponseWrapper::collectionResponse(new ResourceResponse("collection",200,$games),$rs);
    }
}