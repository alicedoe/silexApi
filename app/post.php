<?php
use Symfony\Component\HttpFoundation\Request;

$app->post('/user', "Models\Controller\UserController::postUser");
$app->post('/login', "Models\Controller\UserController::postLoginUser");