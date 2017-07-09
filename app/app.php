<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;


// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());

// Register services.
$app['infosContributeur'] = function ($app) {
    return new Models\Classes\InfosContributeurModel($app['db']);
};
$app['dechets'] = function ($app) {
    return new Models\Classes\DechetsModel($app['db']);
};
$app['favourite'] = function ($app) {
    return new Models\Classes\FavouriteModel($app['db']);
};
$app['contribution'] = function ($app) {
    return new Models\Classes\ContributionModel($app['db']);
};
$app['users'] = function () {
    return new Models\Classes\UsersModel();
};