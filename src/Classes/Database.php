<?php

namespace Models\Classes;

use \PDO;

class Database {

    private $pdo;

    public function __construct($app){

        $this->pdo = new PDO('mysql:host='.$app['db.options']['host'].';dbname='.$app['db.options']['dbname'].';charset=utf8', $app['db.options']['user'], $app['db.options']['password']);
        return new Database();
    }

}