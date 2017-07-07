<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;


// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());

// Register services.
$app['infosContributeur'] = function ($app) {
    return new Models\Tables\InfosContributeur($app['db']);
};
$app['dechets'] = function ($app) {
    return new Models\Tables\Dechets($app['db']);
};
$app['favourite'] = function ($app) {
    return new Models\Tables\Favourite($app['db']);
};
$app['contribution'] = function ($app) {
    return new Models\Tables\ContributionTable($app['db']);
};