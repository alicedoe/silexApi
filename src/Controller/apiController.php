<?php

namespace Models\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Models\Domain\InfosContributeur;

class ApiController {

    /**
     * API articles controller.
     *
     * @param Application $app Silex application
     *
     * @return All users from infos_contributeur in JSON format
     */
    public function getAllUsers(Application $app) {
        $users = $app['dao.infosContributeur']->findAll();
        // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($users as $user) {
            $responseData[] = $app['dao.infosContributeur']->buildUsersArray($user);
        }
//         Create and return a JSON response
        return $app->json($responseData);
    }

}