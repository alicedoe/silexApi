<?php

namespace Models\Classes;

use Silex\Application;
use \PDO;
use \Firebase\JWT\JWT;

class UsersModel
{

    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $pdo;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct() {
        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=circus;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    /**
     * check if email exists
     *
     * @param email
     * @return boolean
     */
    function emailExist($email)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = NULL;

        if (count($rows) > 0) {
            return true;
        } else {
        return false;
        }
    }

    /**
     * check if pseudo exists
     *
     * @param pseudo
     * @return boolean
     */
    function pseudoExist($pseudo)
    {

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username=:pseudo");
        $stmt->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = NULL;

        if (count($rows) > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * check if password is ok
     *
     * @param pseudo
     * @return boolean
     */
    function passwordOk($user)
    {

        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE email=:email");
        $stmt->bindValue(":email", $user['email'], PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = NULL;

         if (password_verify($user['password'],$rows[0]['password'])) {
             return true;
         } else {
            return false;
        }
    }

    /**
     * Add new user
     *
     * @param array containing pseudo,email,password,token
     * @return array containing userid,pseudo,token,
     */
    function createUser($user) {
        $encryptedPassword = password_hash($user['password'],PASSWORD_BCRYPT);
        $none = '0';

        $req = $this->pdo->prepare('INSERT INTO users(username, email, password, remember_token, status) VALUES(:pseudo, :email, :password, :rt, :status)');

        $req->bindParam(':pseudo', $user['pseudo'], PDO::PARAM_STR);
        $req->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $req->bindParam(':password', $encryptedPassword, PDO::PARAM_STR);
        $req->bindParam(':rt', $none, PDO::PARAM_STR);
        $req->bindParam(':status', $none, PDO::PARAM_STR);
        $req->execute();

        $lastid = $this->pdo->lastInsertId();

        $newUser['pseudo'] = $user['pseudo'];
        $newUser['id'] = $lastid;
        $req->closeCursor();
        $req = NULL;

        return $newUser;

    }

    /**
     * Login user
     *
     * @param array containing email,password
     * @return array containing userid,pseudo,token,
     */
    function loginUser($user,$app) {

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindValue(":email", $user['email'], PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll();

        $stmt = $this->pdo->prepare('SELECT * FROM circus_api_token WHERE users_id=:users_id');
        $stmt->bindValue(":users_id", $user[0]['id'], PDO::PARAM_STR);
        $stmt->execute();
        $token = $stmt->fetchAll();

        if (count($token) == 1) {
            return $user;
        } else {
            $token = $this->encodeJwt($user[0]['username'],$app);
            $stmt = $this->pdo->prepare('INSERT INTO circus_api_token(token, users_id) VALUES (:token, :users_id)');
            $stmt->bindValue(":token", $token, PDO::PARAM_STR);
            $stmt->bindValue(":users_id", $user[0]['id'], PDO::PARAM_STR);
            $stmt->execute();
            $stmt = $this->pdo->prepare('SELECT * FROM circus_api_token WHERE users_id=:users_id');
            $stmt->bindValue(":users_id", $user[0]['id'], PDO::PARAM_STR);
            $stmt->execute();
            $userLogged = $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = NULL;
            return $userLogged;
        }

    }

    function encodeJwt($username, Application $app) {
        $key = $app['api']['key'];
        $token = array(
            "iss" => $app['api']['iss'],
            "aud" => $username
        );
        $jwt = JWT::encode($token, $key);
        return $jwt;
    }

    function decodeJwt(Application $app) {
        $token = $_SERVER['HTTP_TOKEN'];
        $key = $app['api']['key'];
        $decoded = JWT::decode($token, $key, array('HS256'));

        return $decoded;
    }

}