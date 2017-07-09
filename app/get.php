<?php

$app->get('/markermap', "Models\Controller\GetController::getUserWithCoord");

$app->get('/search/{word}', "Models\Controller\GetController::getDechetsSearch")->value('word', null );

$app->get('/user/{id}/contribution', "Models\Controller\GetController::getIdeeFromContri")->value('id', null);

$app->get('/useractivated/{id}', "Models\Controller\GetController::getUserActivated")->value('id', null);

$app->get('/user/{id}/allfavoris', "Models\Controller\GetController::getUserFavourite")->value('id', null);

$app->get('/user/{id}/companyfavoris', "Models\Controller\GetController::getUserCompanyFavourite")->value('id', null);

$app->get('/user/{id}/productfavoris', "Models\Controller\GetController::getUserProductFavourite")->value('id', null);

$app->get('/user/{id}', "Models\Controller\GetController::getUser")->value('id', null);

$app->get('/levenshtein/{word}', "Models\Controller\GetController::getLevenshtein")->value('word', null);

$app->get('/contribution/{categorie}', "Models\Controller\GetController::getContributionCategorie")->value('categorie', null);

$app->get('/geocodage', "Models\Controller\GetController::getGeocodage");