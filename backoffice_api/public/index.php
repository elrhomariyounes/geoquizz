<?php

use gq\backoffice\Controllers\AccountController;
use gq\backoffice\Controllers\PhotoController;
use gq\backoffice\Controllers\SerieController;
use gq\backoffice\Helpers\DataBaseHelper;
use gq\backoffice\Helpers\Validator\ValidatorHelper;
use DavidePastore\Slim\Validation\Validation;
use gq\backoffice\Middlewares\CorsMiddleware;
use gq\backoffice\Middlewares\TokenMiddleware;
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

// TODO : delete app health
$app->get('/Hello[/]', function($rq,$rs,$args) use ($container){
    $rs=$rs->withStatus(200)
        ->withHeader('Content-type','application/json');
    $rs->getBody()->write(json_encode(["message"=>"Hello Younes"]));
});

//Register
$app->post('/register[/]',function ($rq,$rs,$args) use ($container){
    return (new AccountController($container))->Register($rq,$rs,$args);
})->add(new Validation(ValidatorHelper::RegisterValidators()));

//Login
$app->post('/login[/]',function ($rq,$rs,$args) use ($container){
    return (new AccountController($container))->Login($rq,$rs,$args);
})->add(new Validation(ValidatorHelper::SignInValidators()));

//Assign serie to a photo
$app->put('/photos/{id}[/]',function ($rq,$rs,$args) use ($container){
    return (new PhotoController($container))->AssignSerieToPhoto($rq,$rs,$args);
})->add(new TokenMiddleware($container));

//Add Photo
$app->post('/photos[/]',function ($rq,$rs,$args) use ($container){
    return (new PhotoController($container))->AddPhoto($rq,$rs);
})->add(new TokenMiddleware($container))->add(new Validation(ValidatorHelper::PhotoValidators()));

//Get user photos
$app->get('/users/{id}/photos[/]',function ($rq,$rs,$args) use ($container){
    return (new PhotoController($container))->GetPhotosByUser($rq,$rs,$args);
})->add(new TokenMiddleware($container));

//Get Series
$app->get('/series[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->GetSeries($rq,$rs);
});

//Get Series
$app->get('/series/{id}[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->GetSerieById($rq,$rs,$args);
});
//Add Serie
$app->post('/series[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->AddSerie($rq,$rs);
})->add(new TokenMiddleware($container))->add(new Validation(ValidatorHelper::SerieValidators()));

//Get Difficulties
$app->get('/difficulties[/]',function ($rq,$rs) use ($container){
    return (new SerieController($container))->GetDifficulties($rq,$rs);
});
$app->run();