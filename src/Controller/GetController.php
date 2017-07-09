<?php

namespace Models\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class GetController {

    /**
     * Swagger ok
     *
     * @param Application $app Silex application
     *
     * @return All users from infos_contributeur in JSON format
     */
    public function getUserWithCoord(Application $app) {
        $users = $app['infosContributeur']->userWithCoord();

        if (count($users) == 0) {
            return $app->json('No user in database with coordinates', 404);
        }

        return $app->json($users);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, string $word to search
     *
     * @return Object dechet who look likes $word
     */
    function getDechetsSearch($word, Application $app)
    {
        if ($word=='') {
            return $app->json('Missing required parameter: word', 400);
        } else {
            $dechets = $app['dechets']->getDechetsSearch($word);
        }

        if (count($dechets) == 0) {
            return $app->json('No result', 404);
        }
        return $app->json($dechets);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, number $id
     *
     * @return One or no user from infos_contributeur in JSON format
     */
    public function getUserActivated($id, Application $app) {
        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Wrong type of parameter: id', 400);
        } else {
            $users = $app['infosContributeur']->getUserActivated($id);
        }

        if (count($users) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($users);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, number $id
     *
     * @return One or no user from infos_contributeur in JSON format
     */
    public function getUser($id, Application $app) {
        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Only number for: id', 400);
        } else {
            $users = $app['infosContributeur']->getUser($id);
        }

        if (count($users) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($users);
    }

    /**
     * Swagger ok
     *
     * @param number $id
     * @param Application $app Silex application
     * @param Request $request Incoming request
     *
     * @return All favourite from an user in JSON format
     */
    public function getUserFavourite($id, Request $request, Application $app) {

        $token = $request->headers->get('token');

        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Wrong type of parameter: id', 400);
        } elseif ( $app['users']->idExist($id)) {
            if ($app['users']->idTokenOk($token,$id)) {
            $users = $app['favourite']->getAll($id);
            } else {
                return $app->json('Wronk token', 400);
            }
        }

        if (count($users) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($users);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, number $id
     *
     * @return All company favourite from an user in JSON format
     */
    public function getUserCompanyFavourite($id, Request $request, Application $app) {

        $token = $request->headers->get('token');

        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Wrong type of parameter: id', 400);
        } elseif ( $app['users']->idExist($id)) {
            if ($app['users']->idTokenOk($token,$id)) {
            $users = $app['favourite']->getCompanyFavourite($id);
            } else {
                return $app->json('Wronk token', 400);
            }
        }

        if (count($users) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($users);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, number $id
     *
     * @return All product favourite from an user in JSON format
     */
    public function getUserProductFavourite($id, Request $request, Application $app) {

        $token = $request->headers->get('token');

        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Wrong type of parameter: id', 400);
        } elseif ( $app['users']->idExist($id)) {
            if ($app['users']->idTokenOk($token,$id)) {
            $users = $app['favourite']->getProductFavourite($id);
            } else {
                return $app->json('Wronk token', 400);
            }
        }

        if (count($users) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($users);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, string $word
     *
     * @return All contribution infos_contributeur from an user in JSON format
     */
    public function getLevenshtein($word, Application $app) {
        if ($word=='') {
            return $app->json('Missing required parameter: word', 400);
        } else {
            $contrib = $app['dechets']->levenshtein($word);
        }

        if (count($contrib) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($contrib);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, string $categorie
     *
     * @return All contribution infos_contributeur from an user in JSON format
     */
    public function getContributionCategorie($categorie, Application $app) {

        if ($categorie=='') {
            return $app->json('Missing required parameter: categorie', 400);
        } else {
            $contrib = $app['contribution']->contributionCategorie($categorie);
        }

        if (count($contrib) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($contrib);
    }

    /**
     * Swagger ok
     *
     * @param Application $app Silex application, int $id
     *
     * @return All contribution idée from the current user in JSON format
     */
    public function getIdeeFromContri($id,Request $request, Application $app) {

        $token = $request->headers->get('token');

        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Only number for: id', 400);
        } elseif ( $app['users']->idExist($id)) {
            if ($app['users']->idTokenOk($token,$id)) {
                $contrib = $app['contribution']->ideeFromContri($id);
            } else {
                return $app->json('Wronk token', 400);
            }
        }


        if (count($contrib) == 0) {
            return $app->json('No result', 404);
        }

        return $app->json($contrib);
    }

    /**
     * TODO : swagger
     *
     * @param Application $app Silex application
     * @param Request $request
     * @param $ref
     * @param $name
     *
     * @return Contribution idee from the current user with reference $ref in JSON format
     */
    public function getIdeeContriRef($id,$ref,Request $request, Application $app) {

        $token = $request->headers->get('token');

        if ($id=='') {
            return $app->json('Missing required parameter: id', 400);
        } if ($ref=='') {
            return $app->json('Missing required parameter: ref', 400);
        } elseif (!is_numeric($id)) {
            return $app->json('Only number for: id', 400);
        } elseif ( $app['users']->idExist($id)) {
            if ($app['users']->idTokenOk($token,$id)) {
            $contrib = $app['contribution']->IdeeContriRef($ref,$id);
            } else {
                return $app->json('Wronk token', 400);
            }
        }

    }

    /**
     * Transforme l'adresse en lontitude lattitude
     *
     * l'adresse doit être indiqué via le headers
     *
     * @param void
     *
     * @return array $results & $result
     */

    function getGeocodage(Application $app) {

        $adresse_complete = $_SERVER['HTTP_ADRESSE'];
        $adresse_complete = utf8_encode($adresse_complete);

            $url="http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($adresse_complete)."&oe=utf8";
            $json = file_get_contents($url);
            $coordonates = json_decode($json);
            $latitude = $coordonates->{"results"}[0]->{'geometry'}->{'location'}->{'lat'};
            $longitude = $coordonates->{"results"}[0]->{'geometry'}->{'location'}->{'lng'};

            if(empty($latitude) or empty($longitude))
            {
                $mapquest = "https://www.mapquestapi.com/geocoding/v1/address?key=HbirHr2IRlmgqfkZT2cUERoLxOMaakzi&inFormat=kvp&outFormat=json&location=".urlencode($adresse_complete)."&thumbMaps=false";
                $json = file_get_contents($mapquest);
                $coordonates = json_decode($json);
                $latitude_mapquest = $coordonates->{'results'}[0]->{'locations'}[0]->{'displayLatLng'}->{'lat'};
                $longitude_mapquest = $coordonates->{'results'}[0]->{'locations'}[0]->{'displayLatLng'}->{'lng'};
                $latitude=$latitude_mapquest;
                $longitude=$longitude_mapquest;
            }
            $results="";

            $results['latitude'] = $latitude;
            $results['longitude'] = $longitude;
        return $app->json($results);

        }

}