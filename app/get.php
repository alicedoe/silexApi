<?php
use Symfony\Component\HttpFoundation\Response;
//
//$app->get('/', function () use ($app) {
//    $articles = $app['dao.article']->findAll();
//    ob_start();             // start buffering HTML output
//    require '../views/view.php';
//    $view = ob_get_clean(); // assign HTML output to $view
//    return $view;
//});

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


$app->GET('/alicegabbana/circus/1.0.0/userscoord', function(Application $app, Request $request) {


    return new Response('How about implementing getUsersCoord as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/login', function(Application $app, Request $request) {
    $name = $request->get('name');    $password = $request->get('password');

    return new Response('How about implementing login as a GET method ?');
});


$app->GET('/alicegabbana/circus/1.0.0/search/{word}', function(Application $app, Request $request, $word) {


    return new Response('How about implementing search as a GET method ?');
});
