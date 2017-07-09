<?php
use Symfony\Component\HttpFoundation\Request;

$app->post('/users', "Models\Controller\UserController::postUser");
$app->post('/login', "Models\Controller\UserController::postLoginUser");