<?php

namespace Models\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class UserController
{
    /**
     * API create new user.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return User details in JSON format
     */
    public function postUser(Request $request, Application $app) {

        $body = json_decode($request->getContent(), true);

        // Check request parameters
        if (!$body['pseudo']) {
            return $app->json('Missing required parameter: pseudo', 400);
        }
        if (!$body['email']) {
            return $app->json('Missing required parameter: email', 400);
        }
        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            return $app->json('Wrong email format', 400);
        }
        if (!$body['password']) {
            return $app->json('Missing required parameter: password', 400);
        }
        $user['pseudo'] = htmlentities(filter_var ($body['pseudo'], FILTER_SANITIZE_STRING));
        $user['email'] = htmlentities(filter_var($body['email'], FILTER_SANITIZE_STRING));
        $user['password'] = htmlentities(filter_var($body['password'], FILTER_SANITIZE_STRING));

        if (!$this->numberLetterUnderscore($user['pseudo'])) {
            return $app->json('Only letter & number for: pseudo', 400);
        }
        if (!$this->numberLetter($user['password'])) {
            return $app->json('Only letter & number for: password', 400);
        }

            if ($app['users']->emailExist($body['email'])) {
                return $app->json('Email already registered', 400);
            } elseif ($app['users']->pseudoExist($user['pseudo'])) {
                return $app->json('Pseudo already registered', 400);
            } else {
                $user = $app['users']->createUser($body);
            }

        return $app->json($user, 201);  // 201 = Created
    }

    /**
     * API check format of a string : only letter & number.
     *
     * @param $string
     *
     * @return boolean
     */
    public function numberLetterUnderscore($string)
    {
        if (preg_match('#^[a-z0-9_]+$#', $string)) {
            return true;
        } else {
            return false;
        }


    }

    /**
     * API login user.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return User details in JSON format
     */
    public function postLoginUser(Request $request, Application $app) {

        $body = json_decode($request->getContent(), true);

        // Check request parameters
        if (!$body['email']) {
            return $app->json('Missing required parameter: email', 400);
        }
        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            return $app->json('Wrong email format', 400);
        }
        if (!$body['password']) {
            return $app->json('Missing required parameter: password', 400);
        }

        $user['email'] = htmlentities(filter_var($body['email'], FILTER_SANITIZE_STRING));
        $user['password'] = htmlentities(filter_var($body['password'], FILTER_SANITIZE_STRING));

        if (!$this->numberLetter($user['password'])) {
            return $app->json('Only letter & number for: password', 400);
        }

        if (!$app['users']->emailExist($user['email'])) {
            return $app->json('Email is not registered', 400);
        } elseif (!$app['users']->passwordOk($user)) {
            return $app->json('Password is wrong', 400);
        } else {
            $user = $app['users']->loginUser($user,$app);
        }

        return $app->json($user, 201);  // 201 = Created
    }

}