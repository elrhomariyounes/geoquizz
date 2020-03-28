<?php

use DavidePastore\Slim\Validation\Validation;
use gq\mobile\Controllers\AccountController;
use gq\mobile\Controllers\PhotoController;
use gq\mobile\Controllers\SerieController;
use gq\mobile\Helpers\DataBaseHelper;
use gq\mobile\Helpers\Validator\ValidatorHelper;
use gq\mobile\Middlewares\TokenMiddleware;
use gq\mobile\Middlewares\CorsMiddleware;
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

//Login
$app->post('/login[/]',function ($rq,$rs) use ($container){
    return (new AccountController($container))->Login($rq,$rs);
})->add(new Validation(ValidatorHelper::SignInValidators()));

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

//Add Serie
$app->post('/series[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->AddSerie($rq,$rs);
})->add(new TokenMiddleware($container))->add(new Validation(ValidatorHelper::SerieValidators()));

//Assign serie to a photo
$app->put('/photos/{id}[/]',function ($rq,$rs,$args) use ($container){
    return (new SerieController($container))->AssignSerieToPhoto($rq,$rs,$args);
})->add(new TokenMiddleware($container));

//Get Difficulties
$app->get('/difficulties[/]',function ($rq,$rs) use ($container){
    return (new SerieController($container))->GetDifficulties($rq,$rs);
});
$app->run();