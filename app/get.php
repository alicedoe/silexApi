<?php

//$app->get('/', function () use ($app) {
//    $articles = $app['dao.infosContributeur']->findAll();
//    ob_start();             // start buffering HTML output
//    require '../views/view.php';
//    $view = ob_get_clean(); // assign HTML output to $view
//    return $view;
//});

// Home page


$app->GET('/alicegabbana/circus/1.0.0/users/{id}/allfavoris', function () use ($app) {


    return new Response('How about implementing getUsersAllFavoris as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/users/{id}/companyfavoris', function(Application $app, Request $request, $id) {


    return new Response('How about implementing getUsersCompanyFavoris as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/users/{id}/contributionidee', function(Application $app, Request $request, $id) {


    return new Response('How about implementing getUsersContribution as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/users/{id}/productfavoris', function(Application $app, Request $request, $id) {


    return new Response('How about implementing getUsersProductsFavoris as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/contributions', function(Application $app, Request $request) {


    return new Response('How about implementing getProducts as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/users/{id}', function(Application $app, Request $request, $id) {


    return new Response('How about implementing getUsers as a GET method ?');
});

$app->GET('/alicegabbana/circus/1.0.0/login', function(Application $app, Request $request) {
    $name = $request->get('name');    $password = $request->get('password');

    return new Response('How about implementing login as a GET method ?');
});

$app->get('/markermap', "Models\Controller\ApiController::getUserWithCoord");

$app->get('/search/{word}', "Models\Controller\ApiController::getDechetsSearch")->value('word', null );

$app->get('/user/{id}/contribution', "Models\Controller\ApiController::getIdeeFromContri")->value('id', null);

$app->get('/useractivated/{id}', "Models\Controller\ApiController::getUserActivated")->value('id', null);

$app->get('/user/{id}/allfavoris', "Models\Controller\ApiController::getUserFavourite")->value('id', null);

$app->get('/user/{id}/companyfavoris', "Models\Controller\ApiController::getUserCompanyFavourite")->value('id', null);

$app->get('/user/{id}/productfavoris', "Models\Controller\ApiController::getUserProductFavourite")->value('id', null);

$app->get('/user/{id}', "Models\Controller\ApiController::getUser")->value('id', null);

$app->get('/levenshtein/{word}', "Models\Controller\ApiController::getLevenshtein")->value('word', null);

$app->get('/contribution', "Models\Controller\ApiController::getAllContribution");