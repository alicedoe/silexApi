<?php

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

$app->get('/markermap', "Models\Controller\GetController::getUserWithCoord");

$app->get('/search/{word}', "Models\Controller\GetController::getDechetsSearch")->value('word', null );

$app->get('/user/{id}/contribution', "Models\Controller\GetController::getIdeeFromContri")->value('id', null);

$app->get('/useractivated/{id}', "Models\Controller\GetController::getUserActivated")->value('id', null);

$app->get('/user/{id}/allfavoris', "Models\Controller\GetController::getUserFavourite")->value('id', null);

$app->get('/user/{id}/companyfavoris', "Models\Controller\GetController::getUserCompanyFavourite")->value('id', null);

$app->get('/user/{id}/productfavoris', "Models\Controller\GetController::getUserProductFavourite")->value('id', null);

$app->get('/user/{id}', "Models\Controller\GetController::getUser")->value('id', null);

$app->get('/levenshtein/{word}', "Models\Controller\GetController::getLevenshtein")->value('word', null);

$app->get('/contribution', "Models\Controller\GetController::getAllContribution");

$app->get('/geocodage', "Models\Controller\GetController::getGeocodage");