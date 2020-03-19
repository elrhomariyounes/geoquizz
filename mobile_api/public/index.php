<?php
use gq\mobile\Controllers\AccountController;
use gq\mobile\Helpers\DataBaseHelper;
use gq\mobile\Helpers\Account\RegisterValidator;
use DavidePastore\Slim\Validation\Validation;

require "../src/vendor/autoload.php";

//pass the settings to slim container
$settings = require_once "../src/Config/GlobalSettings.php";
$slimErrorHandlers = require_once "../src/Config/ErrorHandlers.php";

$config = array_merge($settings,$slimErrorHandlers);
$container = new \Slim\Container($config);

$app = new \Slim\App($container);

//Start Eloquent Connection Database
DataBaseHelper::ConnectToDatabase($app->getContainer()->settings['dbConf']);

// TODO : delete app health
$app->get('/Hello[/]', function($rq,$rs,$args) use ($container){
    $rs=$rs->withStatus(200)
        ->withHeader('Content-type','application/json');
    $rs->getBody()->write(json_encode(["message"=>"Hello Younes"]));
});

//Login
$app->post('/login[/]',function ($rq,$rs,$args) use ($container){
    return (new AccountController($container))->Login($rq,$rs,$args);
})->add(new Validation(RegisterValidator::SignInValidators()));

$app->run();