<?php

use DavidePastore\Slim\Validation\Validation;
use gq\player\Controllers\GameController;
use gq\player\Controllers\SerieController;
use gq\player\Helpers\DataBaseHelper;
use gq\player\Helpers\Validator\ValidatorHelper;
use gq\player\Middlewares\CorsMiddleware;
use gq\player\Middlewares\TokenMiddleware;

require "../src/vendor/autoload.php";
//pass the settings to slim container
$settings = require_once "../src/Config/GlobalSettings.php";
$slimErrorHandlers = require_once "../src/Config/ErrorHandlers.php";

$config = array_merge($settings,$slimErrorHandlers);
$container = new \Slim\Container($config);

$app = new \Slim\App($container);

//Start Eloquent Connection Database
DataBaseHelper::ConnectToDatabase($app->getContainer()->settings['dbConf']);

//Cors Middleware
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
$app->add(new CorsMiddleware($container));


//Create a game
$app->post('/games[/]',function ($rq,$rs,$args) use ($container){
    return (new GameController($container))->CreateGame($rq,$rs);
})->add(new Validation(ValidatorHelper::GameValidators()));

//Get Game info
$app->get('/games/{id}[/]',function ($rq,$rs,$args) use ($container){
    return (new GameController($container))->GetGameById($rq,$rs,$args);
})->add(new TokenMiddleware($container));

//Get game photos
$app->get('/games/{id}/photos[/]',function ($rq,$rs,$args) use ($container){
    return (new GameController($container))->GetGamePhotos($rq,$rs,$args);
})->add(new TokenMiddleware($container));

//Finish Game
$app->put('/games/{id}[/]',function ($rq,$rs,$args) use ($container){
    return (new GameController($container))->FinishGame($rq,$rs,$args);
})->add(new TokenMiddleware($container));

//Get series with random photo
$app->get('/series[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->GetSeriesWithRandomPhoto($rq,$rs,$args);
});

//Get difficulties
$app->get('/difficulties[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->GetDifficulties($rq,$rs);
});

//Get Scores of a serie
$app->get('/series/{id}/scores[/]',function ($rq,$rs,$args) use ($container){
    return (new GameController($container))->GetSerieScores($rq,$rs,$args);
});

//Get top 10 games scores
$app->get('/scores[/]',function ($rq,$rs,$args) use ($container){
    return (new GameController($container))->GetAllGamesScores($rq,$rs,$args);
});
$app->run();